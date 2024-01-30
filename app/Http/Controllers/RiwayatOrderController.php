<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class RiwayatOrderController extends Controller
{
    public function historyOrder()
    {
        $dataCheckout = Cart::with(['checkout', 'product', 'kustomer'])
                        ->where('user_id', Auth::user()->id)
                        ->where('user_id', '!=', 2)
                        ->orderBy('id', 'ASC')->get();
                        
        return view('pages.users.data_account.listHistory', [
            'datas' => $dataCheckout,
        ]);
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
