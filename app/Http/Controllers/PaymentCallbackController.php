<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Checkout;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Midtrans\CallbackService;

class PaymentCallbackController extends Controller
{
    public function receive()
    {
        $callback = new CallbackService;

        if($callback->isSignatureKeyVerified()) {
            $notification = $callback->getNotification();
            $payment = $callback->getPayment();

            if($callback->isSuccess()) {
                Checkout::where('id', $payment->id)->update([
                            'transaction_status' => 'dibayar',
                            'status_pengiriman' => 'pesanan_diterima',
                        ]);

                Cart::where('checkout_id', $payment->id)->update([
                    'payments' => 'paid',
                ]);
            }

            if($callback->isExpire()) {
                Checkout::where('id', '=', $payment->id)
                        ->update([
                            'transaction_status' => 'kadaluarsa'
                        ]);

                $carts = Cart::with(['product'])->where('checkout_id', '=', $payment->id)->get();

                foreach($carts as $item) {
                    $item->product->update([
                        'stock_product' => $item->product->stock_product + $item->quantity,
                    ]);
                }
            }

            if ($callback->isCancelled()) {
                Checkout::where('id', $payment->id)
                    ->update([
                        'transaction_status' => 'batal',
                    ]);

                $carts = Cart::with(['product'])->where('checkout_id', '=', $payment->id)->get();

                foreach ($carts as $item) {
                    $item->product->update([
                        'stock_product' => $item->product->stock_product + $item->quantity,
                    ]);
                }
            }

            return response()
                    ->json([
                        'success' => true,
                        'message' => 'Notification successfully processed',
                    ]);
        } else {
            return response()
                ->json([
                    'error' => true,
                    'message' => 'Signature key not verified',
                ], 403);
        }
    }
}
