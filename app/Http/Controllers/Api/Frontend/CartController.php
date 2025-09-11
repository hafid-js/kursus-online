<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Course;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    use ApiResponseTrait;



    /**
     * Get paginated cart items for authenticated user
     */
    public function index(Request $request): JsonResponse
    {
        $cart = Cart::with('course')
            ->where('user_id', auth()->id())
            ->paginate(10);

        return $this->sendResponse($cart, 'Cart items retrieved successfully');
    }

    /**
     * Get count of cart items for authenticated user
     */
    public function cartCount(): JsonResponse
    {
        $count = Cart::where('user_id', auth()->id())->count();

        return $this->sendResponse(['count' => $count], 'Cart count retrieved successfully');
    }

    /**
     * Add a course to cart
     */
    public function addToCart(int $id): JsonResponse
    {
        $userId = auth()->id();

        if (Cart::where(['course_id' => $id, 'user_id' => $userId])->exists()) {
            return $this->sendError('Course already added to cart', 409);
        }

        $course = Course::find($id);
        if (!$course) {
            return $this->sendError('Course not found', 404);
        }

        Cart::create([
            'course_id' => $course->id,
            'user_id' => $userId,
        ]);

        return $this->sendResponse(null, 'Course added to cart successfully');
    }

    /**
     * Remove an item from cart
     */
    public function removeFromCart(int $id): JsonResponse
    {
        $cart = Cart::where(['id' => $id, 'user_id' => auth()->id()])->first();

        if (!$cart) {
            return $this->sendError('Cart item not found', 404);
        }

        $cart->delete();

        return $this->sendResponse(null, 'Removed from cart successfully');
    }
}
