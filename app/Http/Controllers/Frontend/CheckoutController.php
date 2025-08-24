<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = auth()->user();
          $cart = Cart::with('course')
                ->where('user_id', $user->id)
                ->get();
        return view('frontend.pages.checkout-page', compact('cart','user'));
    }
}
