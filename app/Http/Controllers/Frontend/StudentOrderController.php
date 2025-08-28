<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;

class StudentOrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('buyer_id', user()->id)->get();

        return view('frontend.student-dashboard.order.index', compact('orders'));
    }

    public function show(string $id)
    {
        $order = Order::where('buyer_id', user()->id)->findOrFail($id);

        return view('frontend.student-dashboard.order.show', compact('order'));
    }
}
