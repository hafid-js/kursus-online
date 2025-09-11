<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class StudentOrderController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $orders = Order::where('buyer_id', auth()->id())
            ->with('orderItems.course') // Optional: eager load course
            ->latest()
            ->get();

        return $this->sendResponse($orders, 'Orders retrieved successfully.');
    }

    public function show(string $id)
    {
        $order = Order::with('orderItems.course')
            ->where('buyer_id', auth()->id())
            ->findOrFail($id);

        return $this->sendResponse($order, 'Order detail retrieved successfully.');
    }
}
