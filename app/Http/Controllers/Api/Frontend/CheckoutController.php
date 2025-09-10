<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    use ApiResponseTrait;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function __invoke(Request $request): JsonResponse
    {
        $user = auth()->user();

        $cart = Cart::with('course')
            ->where('user_id', $user->id)
            ->get();

        return $this->sendResponse([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
            'cart' => $cart,
        ], 'Checkout data retrieved successfully');
    }
}
