<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orderItems = OrderItem::whereHas('course', function ($query) {
            $query->where('instructor_id', user()->id);
        })->paginate(25);

        return response()->json($orderItems);
    }
}
