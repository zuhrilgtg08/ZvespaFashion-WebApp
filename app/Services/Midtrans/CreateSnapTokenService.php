<?php

namespace App\Services\Midtrans;

use App\Models\Cart;
use Midtrans\Snap;
use Illuminate\Support\Facades\Auth;

class CreateSnapTokenService extends Midtrans
{
    protected $payment;

    public function __construct($payment)
    {
        parent::__construct();

        $this->payment = $payment;
    }

    public function getSnapToken()
    {
        $dataOrder = Cart::with('product', 'checkout')
            ->where('user_id', auth()->user()->id)
            ->where('payments', null)->get();

        $item_details = [];

        foreach ($dataOrder as $item) {
            $item_details[] = [
                'id' => $this->payment->uuid,
                'price' => $item->product->harga_product,
                'quantity' => $item->quantity,
                'name' => $item->product->name_product
            ];
        }

        $item_details[] = [
            'id' => $this->payment->uuid,
            'price' => $this->payment->harga_ongkir,
            'name' => 'Ongkos Kirim',
            'quantity' => 1
        ];

        $item_details[] = [
            'id' => $this->payment->uuid,
            'price' => 5000,
            'name' => 'Biaya Admin',
            'quantity' => 1
        ];

        $params = [
            'transaction_details' => [
                'order_id' => $this->payment->uuid,
                'gross_amount' => $this->payment->total_amount + $this->payment->harga_ongkir,
            ],
            'item_details' => $item_details,
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => Auth::user()->phone_number,
            ]
        ];

        $snapToken = Snap::getSnapToken($params);

        return $snapToken;
    }
}
