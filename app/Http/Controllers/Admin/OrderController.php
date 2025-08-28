<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CourseOrdersDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    public function index(CourseOrdersDataTable $dataTable)
    {
        return $dataTable->render('admin.order.index');
    }

    public function show(Order $order)
    {
        $modalType = request('modal', 'courses');

        if ('courses' === $modalType) {
            return response()->view('admin.order.partials.courses-order', compact('order'));
        } elseif ('invoice' === $modalType) {
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
