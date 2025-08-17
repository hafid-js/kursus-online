<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CourseOrdersDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
      public function index(CourseOrdersDataTable $dataTable)
    {
        return $dataTable->render('admin.order.index');
    }



    function show(Order $order)
    {
        return response()->view('admin.order.partials.order-modal', compact('order'));
    }
}
