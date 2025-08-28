<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;

class InstructorOrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('buyer_id', user()->id)->get();

        return view('frontend.instructor-dashboard.order.index', compact('orders'));
    }

    public function show(string $id)
    {
        $order = Order::where('buyer_id', user()->id)->findOrFail($id);

        return view('frontend.instructor-dashboard.order.show', compact('order'));
    }
}
