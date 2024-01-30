<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CheckoutController extends Controller
{
    public function payment()
    {
        $cartData = Cart::with(['product', 'checkout'])->where('user_id', Auth::user()->id)->where('status', 'ordered')
                        ->get();

        $snapToken = null;
        $totalHarga = 0;

        foreach ($cartData as $data) {
            $snapToken = $data->checkout->snap_token;
            $totalHarga += $data->product->harga_product * $data->quantity;
        }

        return view('pages.users.pesanan.payment', compact('snapToken', 'cartData', 'totalHarga'));
    }

    public function konfirmasiPayment(Request $request)
    {
        $cartData = Cart::where('user_id', Auth::user()->id)->where('payments', '=', null)->get();

        $json_data = json_decode($request->json);
        $pay_data = [
            'transaction_id' => isset($json_data->transaction_id) ? $json_data->transaction_id : null,
            'transaction_status' => $json_data->transaction_status,
            'transaction_time' => isset($json_data->transaction_time) ? $json_data->transaction_time : null,
            'payment_type' => $json_data->payment_type,
            'link_pdf' => isset($json_data->pdf_url) ? $json_data->pdf_url : null,
            'status_pengiriman' => 'sedang_dikirim',
        ];

        foreach ($cartData as $data) {
            if ($json_data->transaction_status == 'settlement') {
                $data->update([
                    'status' => 'complete',
                    'payments' => 'paid'
                ]);
            }
        }

        $checkout = Checkout::where('uuid', '=', isset($json_data->order_id) ? $json_data->order_id : null)->first();
        if ($checkout) {
            $checkout->update($pay_data);
        }

        if ($checkout->transaction_status == 'settlement') {
            Alert::toast('Payment is settlement, Thank you!', 'success')->position('top-end');
            return redirect()->route('history.index');
        } elseif ($checkout->transaction_status == 'pending') {
            Alert::toast('Payment is pending, Please Pay Now!', 'warning')->position('top-end');
            return redirect()->route('history.index');
        } else {
            Alert::toast('Payment is error, Please Correct again something when wrong!', 'error')->position('top-end');
            return redirect()->back();
        }
    }
}
