<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
   function index() {
    $orders = Order::with(['customer'])->paginate(25);
     return view('admin.order.index', compact('orders'));
   }

   function show(Order $order) {
    return response()->view('admin.order.order-modal', compact('order'));
   }
}
