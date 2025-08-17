<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CourseOrdersDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    public function index(CourseOrdersDataTable $dataTable)
    {
        return $dataTable->render('admin.order.index');
    }


    function show(Order $order)
    {
        $modalType = request('modal', 'courses');

        if ($modalType === 'courses') {
            return response()->view('admin.order.partials.courses-order', compact('order'));
        } else if ($modalType === 'invoice') {
            return response()->view('admin.order.partials.invoice', compact('order'));
        }

        // fallback
        return response()->view('admin.order.partials.invoice', compact('order'));
    }


    // public function export()
    // {
    //     return Excel::download(new UsersExport, 'users.xlsx');
    // }
}
