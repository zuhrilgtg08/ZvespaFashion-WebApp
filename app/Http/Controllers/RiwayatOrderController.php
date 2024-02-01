<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use PDF;

class RiwayatOrderController extends Controller
{
    public function historyOrder(Request $request)
    {
        if($request->ajax()) {
            $query = Cart::join('products_vespa', 'products_vespa.id', '=', 'carts.product_id')
                        ->join('checkouts', 'checkouts.id', '=', 'carts.checkout_id')
                        ->where('user_id', '=', Auth::user()->id)
                        ->where('user_id', '!=', 2)
                        ->select(
                            'carts.id as id',
                            'products_vespa.name_product as nama_vespa',
                            'carts.quantity as kuantitas',
                            'products_vespa.harga_product as price',
                            'carts.checkout_id as checkout_id',
                            'carts.status as ship_status',
                        )->get();

            return DataTables::of($query)
                ->addColumn('action', function ($row) {
                    return '
                            <a href="/history/detail/' . $row->id . '" class="btn btn-primary btn-sm"><i class="fas fa-info-circle"></i> Detail</a>
                            <a href="/history/print/' . $row->checkout_id . '" class="btn btn-danger btn-sm"><i class="fas fa-print"></i></a>
                        ';
                })->editColumn("price", function ($row) {
                    return number_format($row->price, 0, ',', '.');
                })
                ->rawColumns(['action', 'price'])
                ->addIndexColumn()
                ->make(true); 
        }

        
        return view('pages.users.data_account.listHistory');
    }

    public function detailOrder(string $id)
    {
        $data = Cart::with(['product','kustomer','checkout'])->where('checkout_id', '=', $id)->get();

        $noInvoice = null;
        $provinsi = null;
        $kota = null;
        $alamat = null;
        $kurir = null;
        $paket = null;
        $ongkir = 0;
        $total_harga = 0;
        $payment = 0;
        $status = null;

        foreach ($data as $dt) {
            $kurir = $dt->checkout->courier;
            $paket = $dt->checkout->layanan_ongkir;
            $ongkir = $dt->checkout->harga_ongkir;
            $total_harga = $dt->checkout->total_amount;
            $payment = $dt->checkout->harga_ongkir + $dt->checkout->total_amount;
            $noInvoice = $dt->checkout->uuid;
            $provinsi = $dt->checkout->province->name_province;
            $kota = $dt->checkout->cities->nama_kab_kota;
            $alamat = $dt->checkout->alamat;
            $status = $dt->checkout->transaction_status;
        }

        return view('pages.users.data_account.detailHistory', compact(
            'data', 'kurir', 'paket', 'ongkir', 'total_harga', 'payment', 
            'noInvoice','provinsi', 'kota', 
            'alamat', 'status'
        ));
    }

    public function cetakStruk(string $id)
    {
        $datas = Cart::with(['product', 'checkout'])
                ->where('user_id', Auth::user()->id)
                ->where('checkout_id', '=', $id)
                ->get();

        $noInvoice = null;
        $provinsi = null;
        $kota = null;
        $alamat = null;
        $paket = null;
        $ongkir = 0;
        $total_harga = 0;
        $payment = 0;
        $status = null;

        foreach ($datas as $dt) {
            $paket = $dt->checkout->layanan_ongkir;
            $ongkir = $dt->checkout->harga_ongkir;
            $total_harga = $dt->checkout->total_amount;
            $payment = $dt->checkout->harga_ongkir + $dt->checkout->total_amount;
            $noInvoice = $dt->checkout->uuid;
            $provinsi = $dt->checkout->province->name_province;
            $kota = $dt->checkout->cities->nama_kab_kota;
            $alamat = $dt->checkout->alamat;
            $status = $dt->checkout->transaction_status;
        }

        $pdf = PDF::loadView('pages.users.cetak.index', compact(
            'datas','paket','ongkir','total_harga',
            'payment','noInvoice','provinsi',
            'kota','alamat','status'
        ));

        $pdf->setPaper('a4', 'landscape');

        return $pdf->download("Invoice " . date('d-m-Y') . '.pdf');
    }

    public function successNotif()
    {
        Alert::toast('Your product has been ordered, Please payment now!', 'success')->position('top-end');
        return redirect()->route('history.index');
    }

    public function pendingNotif()
    {
        Alert::toast('Payment is pending, Please Pay Now!', 'warning')->position('top-end');
        return redirect()->route('history.index');
    }

    public function errorNotif()
    {
        Alert::toast('Payment is error, Please Correct again something when wrong!', 'error')->position('top-end');
        return redirect()->route('checkout.pay');
    }
}
