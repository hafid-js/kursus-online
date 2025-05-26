<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() {
        $orderItems = OrderItem::whereHas('course', function($query) {
            $query->where('instructor_id', user()->id);})->paginate(25);
        return view('frontend.instructor-dashboard.order.index', compact('orderItems'));
    }
}
