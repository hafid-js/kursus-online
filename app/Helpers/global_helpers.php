<?php

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

if(!function_exists('convertMinutesToHours')) {
    function convertMinutesToHours(int $minutes) : string {
        $hours = floor($minutes / 60);
        $minutes = $minutes % 60;
        return sprintf('%dh %02dm', $hours, $minutes); // returns format : 1h:30m
    }
}

if(!function_exists('user')) {
    function user() {
        return auth('web')->user();
    }
}

if(!function_exists('adminUser')) {
    function adminUser() {
        return auth('admin')->user();
    }
}

if(!function_exists('cartCount')) {
    function cartCount() {
        return Cart::where('user_id', user()?->id)->count();
    }
}

if(!function_exists('cartTotal')) {
    function cartTotal() {
        $total = 0;

        $cart = Cart::where('user_id', user()->id)->get();

        foreach($cart as $item) {
            if($item->course->discount > 0) {
                $total += $item->course->discount;
            } else {
                $total += $item->course->price;
            }
        }
        return $total;
    }
}
