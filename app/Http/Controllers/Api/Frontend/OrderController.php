<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use ApiResponseTrait;



    public function index(Request $request): JsonResponse
    {
        $user = auth()->user();

        $orderItems = OrderItem::whereHas('course', function ($query) use ($user) {
            $query->where('instructor_id', $user->id);
        })->paginate(25);

        return $this->sendPaginatedResponse(
            $orderItems->items(),
            'Order items retrieved successfully',
            [
                'current_page' => $orderItems->currentPage(),
                'last_page' => $orderItems->lastPage(),
                'per_page' => $orderItems->perPage(),
                'total' => $orderItems->total(),
            ]
        );
    }
}
