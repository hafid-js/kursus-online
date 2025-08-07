<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class InstructorOrderController extends Controller
{
    function index() {
        $orders = Order::where('buyer_id', user()->id)->get();
        return view('frontend.instructor-dashboard.order.index', compact('orders'));
    }

    function show(string $id) {
        $order = Order::where('buyer_id', user()->id)->findOrFail($id);
        return view('frontend.instructor-dashboard.order.show', compact('order'));
    }
}
