<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    public function list()
    {
        $list = Cart::with(['kustomer', 'product'])->where([
            ['user_id', '=', Auth::user()->id],
            ['status', '=', 'onList']
        ])->get();
        $qty = 0;
        $amount = 0;
        foreach ($list as $data) {
            if ($data->quantity >= $data->product->stock_product) {
                $amount += $data->product->stock_product * $data->product->harga_product;
                $qty += $data->product->stock_product;
            } else {
                $amount += $data->quantity * $data->product->harga_product;
                $qty += $data->quantity;
            }
        }

        return view('pages.users.pesanan.cart_list', [
            'qty' => $qty,
            'list' => $list,
            'amount' => $amount,
        ]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'product_id' => 'required',
        ]);

        $datas = Cart::with('product')->where('product_id', '=', $request->product_id)->get();

        foreach ($datas as $data) {
            if ($data->quantity > $data->product->stock_product) {
                $data['quantity'] = $data->quantity;
                Alert::toast('Sory, you ordered more than the available product stock limit!', 'error')->position('top-end');
                return redirect()->route('cart.list');
            } else {
                $data->quantity;
            }
        }

        $cartCheck = Cart::where([
            ['product_id', '=', $request->product_id],
            ['user_id', '=', Auth::user()->id],
            ['status', '<>', 'complete']
        ])->first();

        $cartDatas = Cart::with('product')->where([
            ['product_id', '=', $request->product_id],
            ['user_id', '=', Auth::user()->id]
        ])->get();

        if ($cartCheck) {
            if (($request->quantity + $cartDatas[0]->quantity) > $cartDatas[0]->product->stock_product)
                Alert::toast('Sory, you ordered more than the available product stock limit!', 'error')->position('top-end');
                return redirect()->route('cart.list');

            if ($request->quantity) {
                $cartCheck->update(['quantity' => $cartCheck->quantity + $request->quantity]);
            } else {
                $cartCheck->update(['quantity' => $cartCheck->quantity + 1]);
            }

            $validate['user_id'] = Auth::user()->id;
            $validate['status'] = 'onList';
            $validate['checkout_id'] = 0;
        } else {
            foreach ($cartDatas as $data) {
                if ($data->product_id) {
                    $validate['user_id'] = Auth::user()->id;
                    $validate['quantity'] = $request->quantity;
                    $validate['status'] = 'onList';
                    $validate['checkout_id'] = 0;
                }
            }

            $validate['user_id'] = Auth::user()->id;
            $validate['quantity'] = $request->quantity;
            $validate['status'] = 'onList';
            $validate['checkout_id'] = 0;
            Cart::create($validate);
        }
        Alert::toast('Your order has been added to the cart!', 'success')->position('top-end');
        return redirect()->route('cart.list');
    }

    public function update(Request $request, string $id)
    {
        $datas = [
            'quantity' => $request->input('quantity'),
        ];

        if ($datas['quantity'] <= 0 || $request->quantity <= 0) {
            Cart::findOrFail($id)->delete();
            Alert::toast('Your order has been deleted to the cart!', 'error')->position('top-end');
            return redirect()->route('cart.list');
        } else {
            Cart::findOrFail($id)->update($datas);
            Alert::toast('Your order has been updated to the cart!', 'success')->position('top-end');
            return redirect()->route('cart.list');
        }
    }

    public function destroy(string $id)
    {
        Cart::findOrFail($id)->delete();
        Alert::toast('Your order has been deleted to the cart!', 'info')->position('top-end');
        return redirect()->route('cart.list');
    }
}
