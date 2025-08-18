<?php

use App\Models\Cart;
use Carbon\Carbon;
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
    return user()?->id ? Cart::where('user_id', user()->id)->count() : 0;
}}

if (!function_exists('cartTotal')) {
    function cartTotal() {
        $total = 0;

        $cart = Cart::where('user_id', user()->id)->get();

        foreach ($cart as $item) {
            $price = $item->course->price;
            $discount = $item->course->discount;

            // calculate total after discount
            $discountedPrice = $price - ($price * ($discount / 100));
            $total += $discountedPrice;
        }

        return $total;
    }
}

if (!function_exists('getFinalPrice')) {
    function getFinalPrice($price, $discount) {
        return $price - ($price * $discount / 100);
    }
}

if (!function_exists('calculateSubtotal')) {
    function calculateSubtotal($orders) {
        return $orders->sum('course_price');
    }
}

if (!function_exists('calculateTotalAfterDiscount')) {
    function calculateTotalAfterDiscount($orders) {
        return $orders->sum(function ($order) {
            return getFinalPrice($order->course_price, $order->course_discount);
        });
    }
}


/** calculate cart total */
if(!function_exists('calculateCommission')) {
    function calculateCommission($amount, $commission) {
        return $amount == 0 ? 0 : ($amount * $commission) / 100;
    }
}

// sidebar item active
if(!function_exists('sidebarItemActive')) {
    function sidebarItemActive(array $routes) {

        foreach($routes as $route) {
            if(request()->routeIs($route)){
                return 'active';
            }
        }
    }
}

// navbar item active
if(!function_exists('navbarItemActive')) {
    function navbarItemActive(string $route) {
            return request()->routeIs($route) ? 'active' : '';
    }
}
// navbar index item active
if (!function_exists('navbarItemIndexActive')) {
    function navbarItemIndexActive(string $url)
    {
        return request()->is($url) ? 'active' : '';
    }
}

// is document instructor request is approved?
function isDocumentApproved($user)
{
    return !empty($user->document) && $user->document_status === 'approved';
}

if (!function_exists('format_to_date')) {
    function format_to_date($date)
    {
        // Carbon::setLocale('id');
        return Carbon::parse($date)->translatedFormat('d F Y H:i');
        // Output: 08 Agustus 2025
    }
}

if (!function_exists('getUserInitials')) {
    function getUserInitials($name)
    {
        if (!$name) return '';

        // take the first two words
        $words = explode(' ', trim($name));
        $initials = strtoupper(substr($words[0], 0, 1));

        if (isset($words[1])) {
            $initials .= strtoupper(substr($words[1], 0, 1));
        }

        return $initials;
    }
}




