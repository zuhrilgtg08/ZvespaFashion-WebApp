<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Categories;
use Illuminate\Support\Facades\View;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->user()) {
                $cart = Cart::where('user_id', auth()->user()->id)
                    ->where('status', '=', 'added')->get();
                View::share('cart', $cart);
            } else {
                $categories = Categories::get();
                View::share('categories', $categories);
            }

            return $next($request);
        });
    }
}
