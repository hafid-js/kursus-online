<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Course;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(): JsonResponse
    {
        $user = Auth::guard('api')->user();

        $cartItems = Cart::with('course')
            ->where('user_id', $user->id)
            ->paginate(10);

        return response()->json([
            'message' => 'Cart retrieved successfully.',
            'data' => CartResource::collection($cartItems),
            'pagination' => [
                'current_page' => $cartItems->currentPage(),
                'last_page' => $cartItems->lastPage(),
                'per_page' => $cartItems->perPage(),
                'total' => $cartItems->total(),
            ],
        ]);
    }

    public function addToCart(int $id): JsonResponse
    {
        $user = Auth::guard('api')->user();

        if ('instructor' === $user->role) {
            return response()->json([
                'message' => 'Please use a student account to add to cart.',
            ], 403);
        }

        $alreadyExists = Cart::where('course_id', $id)
            ->where('user_id', $user->id)
            ->exists();

        if ($alreadyExists) {
            return response()->json([
                'message' => 'Course already in cart.',
            ], 409);
        }

        $course = Course::find($id);
        if (!$course) {
            return response()->json([
                'message' => 'Course not found.',
            ], 404);
        }

        $cart = new Cart();
        $cart->course_id = $course->id;
        $cart->user_id = $user->id;
        $cart->save();

        $cart->load('course');

        return response()->json([
            'message' => 'Course added to cart successfully.',
            'data' => new CartResource($cart),
        ], 201);
    }

    public function removeFromCart(int $id): JsonResponse
    {
        $user = Auth::guard('api')->user();

        $cart = Cart::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if (!$cart) {
            return response()->json([
                'message' => 'Cart item not found.',
            ], 404);
        }

        $cart->delete();

        return response()->json([
            'message' => 'Item removed from cart successfully.',
        ], 200);
    }
}
