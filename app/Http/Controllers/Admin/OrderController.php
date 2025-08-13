<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query();

        if ($request->has('search')) {
            $search = $request->input('search');

            $query->whereHas('customer', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }
        $orders = $query->with('customer')->paginate(25);

        if ($request->ajax() && $request->has('search')) {
            return view('admin.order.partials.table', compact('orders'))->render();
        }
        return view('admin.order.index', compact('orders'));
    }


    function show(Order $order)
    {
        return response()->view('admin.order.partials.order-modal', compact('order'));
    }
}
