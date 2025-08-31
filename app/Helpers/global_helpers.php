<?php

use App\Models\Cart;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

if (!function_exists('convertMinutesToHours')) {
    function convertMinutesToHours(int $minutes): string
    {
        $hours = floor($minutes / 60);
        $minutes = $minutes % 60;

        return sprintf('%dh %02dm', $hours, $minutes); // returns format : 1h:30m
    }
}

if (!function_exists('user')) {
    function user()
    {
        return auth('web')->user();
    }
}

if (!function_exists('adminUser')) {
    function adminUser()
    {
        return auth('admin')->user();
    }
}

if (!function_exists('cartCount')) {
    function cartCount()
    {
        return user()?->id ? Cart::where('user_id', user()->id)->count() : 0;
    }
}

if (!function_exists('cartTotal')) {
    function cartTotal()
    {
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
    function getFinalPrice($price, $discount)
    {
        return $price - ($price * $discount / 100);
    }
}

if (!function_exists('calculateSubtotal')) {
    function calculateSubtotal($orders)
    {
        return $orders->sum('course_price');
    }
}

if (!function_exists('calculateTotalAfterDiscount')) {
    function calculateTotalAfterDiscount($orders)
    {
        return $orders->sum(function ($order) {
            return getFinalPrice($order->course_price, $order->course_discount);
        });
    }
}

function calculateCommissionInIdr($amount, $commissionRate, $currency, $createdAt)
{
    $commission = calculateCommission($amount, $commissionRate);

    if (!$commission || $commission <= 0) {
        return 0;
    }

    $rate = get_kurs_to_idr_from_created_at($createdAt, $currency);

    if (!$rate || $rate <= 0) {
        // Bisa log error di sini juga kalau perlu
        return 0;
    }

    return round($commission * $rate, 2);
}

if (!function_exists('format_rupiah')) {
    function format_rupiah($amount)
    {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
}

/** calculate cart total */
if (!function_exists('calculateCommission')) {
    function calculateCommission($amount, $commission)
    {
        return 0 == $amount ? 0 : ($amount * $commission) / 100;
    }
}

// sidebar item active
if (!function_exists('sidebarItemActive')) {
    function sidebarItemActive(array $routes)
    {
        foreach ($routes as $route) {
            if (request()->routeIs($route)) {
                return 'active';
            }
        }
    }
}

// navbar item active
if (!function_exists('navbarItemActive')) {
    function navbarItemActive(string $route)
    {
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
    return !empty($user->document) && 'approved' === $user->document_status;
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
        if (!$name) {
            return '';
        }

        // take the first two words
        $words = explode(' ', trim($name));
        $initials = strtoupper(substr($words[0], 0, 1));

        if (isset($words[1])) {
            $initials .= strtoupper(substr($words[1], 0, 1));
        }

        return $initials;
    }
}

function generateOrderId()
{
    $prefix = 'ORDER-';
    $date = date('Ymd');
    $random = strtoupper(substr(bin2hex(random_bytes(3)), 0, 6));

    return $prefix . $date . '-' . $random;
}

if (!function_exists('get_kurs_to_idr_from_created_at')) {
    function get_kurs_to_idr_from_created_at($createdAt, $currency)
    {
        $date = Carbon::parse($createdAt)->format('Y-m-d');
        $currency = strtoupper($currency);
        $cacheKey = "kurs_{$currency}_to_idr_{$date}";

        return Cache::remember($cacheKey, now()->addDays(7), function () use ($date, $currency) {
            $response = Http::get("https://api.exchangerate.host/{$date}", [
                'base' => $currency,
                'symbols' => 'IDR',
            ]);

            if ($response->successful()) {
                return $response->json()['rates']['IDR'] ?? null;
            }

            return null;
        });
    }
}

if (!function_exists('convert_to_idr_from_created_at')) {
    function convert_to_idr_from_created_at($amount, $createdAt, $currency)
    {
        $rate = get_kurs_to_idr_from_created_at($createdAt, $currency);

        if ($rate) {
            return round($amount * $rate, 2);
        }

        return null;
    }
}

if (!function_exists('cartTotalDiscount')) {
    function cartTotalDiscount()
    {
        $cart = Cart::where('user_id', user()?->id)->get();

        $totalDiscount = 0;

        foreach ($cart as $item) {
            $price = $item->course->price;
            $discount = $item->course->discount;

            if ($discount > 0) {
                $totalDiscount += ($price * $discount) / 100;
            }
        }

        return $totalDiscount;
    }
}
