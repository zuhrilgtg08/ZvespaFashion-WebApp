<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cities;
use App\Models\Checkout;
use App\Models\Provinces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Services\Midtrans\CreateSnapTokenService;

class ShippingController extends Controller
{
    public function getCity(string $id)
    {
        $data = Cities::where('province_id', '=', $id)->get(['id', 'nama_kab_kota', 'province_id']);
        return response()->json($data);
    }

    public function cekOngkir(string $destination, $weight, string $courier)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=444&destination=$destination&weight=$weight&courier=$courier",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: 91dd56b26cc7b9a58d9c1112b28d9244"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response, true);
            $data_ongkir = $response['rajaongkir']['results'];
            return json_encode($data_ongkir);
        }
    }

    public function create()
    {
        $get_data_checkout = Checkout::all();

        $snapToken = null;
        foreach ($get_data_checkout as $data) {
            $snapToken = $data->snap_token;
        }

        $cart = Cart::with(['product'])->where([
                                ['user_id', '=', Auth::user()->id],
                                ['status', '<>', 'complete'],
                                ['status', '<>', 'ordered']
                            ])->get();

        $provinsi = Provinces::with(['user'])->get(['id', 'name_province']);

        if (Auth::user()->u_prov_id !== 0 && Auth::user()->u_kota_id !== 0) {
            $kota = Cities::where('province_id', '=', auth()->user()->u_prov_id)->get(['id', 'nama_kab_kota', 'province_id']);
        } else {
            $kota = Cities::join('provinces', 'provinces.id', '=', 'cities.province_id')->get(['cities.*']);
        }

        $totalWeight = 0;
        $totalAmount = 0;
        $quantity = 0;

        foreach($cart as $data) {
            $quantity += $data->quantity;
            $totalWeight += $data->product->weight_product * $data->quantity;
            $totalAmount += $data->product->harga_product * $data->quantity;
        }

        return view('pages.users.pesanan.shipping', [
            'items' => $cart,
            'kota' => $kota,
            'provinsi' => $provinsi,
            'weight' => $totalWeight,
            'total_amount' => $totalAmount,
            'quantity' => $quantity,
            'snapToken' =>  $snapToken,
        ]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'province_id' => 'required',
            'destination_id' => 'required',
            'courier' => 'required|string|max:150',
            'total_berat' => 'numeric|required|min:1',
            'harga_ongkir' => 'required|numeric|integer',
            'layanan_ongkir' => 'required|string',
            'total_amount' => 'required|numeric|integer',
            'alamat' => 'required|string',
        ]);

        $shipping = Checkout::create($validate);

        $datas = Cart::with(['checkout', 'product'])->where([
                                ['user_id', '=', Auth::user()->id],
                                ['status', '<>', 'complete'],
                                ['status', '<>', 'ordered'],
                            ])->get();

        foreach($datas as $data) {
            $data->product->update([
                'stock_product' => $data->product->stock_product - $data->quantity,
            ]);

            if($data->status == 'onList') {
                $data->update([
                    'status' => 'ordered',
                    'checkout_id' => $shipping->id,
                ]);
            }

            if (!empty($data->checkout_id)) {
                $midtrans = new CreateSnapTokenService($shipping);
                $snapToken = $midtrans->getSnapToken();
                $shipping->update(['snap_token' => $snapToken]);
            }
        }

        if($shipping) {
            Alert::toast('Your product has been ordered, Please payment now!', 'success')->position('top-end');
            return redirect()->route('checkout.pay');
        } else {
            Alert::toast('Something when wrong, please correct your order again!', 'error')->position('top-end');
            return redirect()->back();
        }
    }
}
