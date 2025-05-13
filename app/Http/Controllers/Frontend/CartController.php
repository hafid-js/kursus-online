<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    function index()
    {
        $cart = Cart::with(['course'])->where(['user_id' => Auth::id()])->paginate();
        return view('frontend.pages.cart', compact('cart'));
    }

    function addToCart(int $id): Response
    {

        if (!Auth::guard('web')->check()) {
            return response([
                'message' => 'Please Login First'
            ], 401);
        }

        if(Cart::where([
            'course_id' => $id,
            'user_id' => Auth::guard('web')->user()->id
        ])->exists()) {
            return response ([
                'message' => 'Already Added!'
            ], 401);
        }

        $course = Course::findOrFail($id);
        $cart = new Cart();
        $cart->course_id = $course->id;
        $cart->user_id = Auth::guard('web')->user()->id;
        $cart->save();

        return response([
            'message' => 'Added Successfully!'
        ], 200);
    }

    function removeFromCart(int $id) : RedirectResponse {
        $cart = Cart::where(['id' => $id, 'user_id' => Auth::id()])->firstOrFail();
        $cart->delete();
        notyf()->success('Removed Successfully!');
        return redirect()->back();
    }

}
