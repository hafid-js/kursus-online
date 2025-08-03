<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class StudentOrderController extends Controller
{
    public function index(): JsonResponse
    {
        $orders = Order::where('buyer_id', auth()->id())->get();
        return response()->json(['orders' => $orders]);
    }

    public function show(string $id): JsonResponse
    {
        $order = Order::where('buyer_id', auth()->id())->findOrFail($id);
        return response()->json(['order' => $order]);
    }
}
