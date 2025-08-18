<?php

namespace App\Http\Controllers\Export;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CourseOrderExport;

class ExportController extends Controller
{
    public function courseExportOrders(Request $request)
    {
        $ids = array_filter(explode(',', $request->ids ?? ''));
        if (empty($ids)) {
            return redirect()->back()->with('error', 'No orders selected for export.');
        }
        return Excel::download(new CourseOrderExport($ids), 'course_orders.xlsx');
    }

    public function exportSelected(Request $request)
    {
        $ids = $request->input('ids', []);
        $type = $request->query('type', 'excel');

        if (empty($ids)) {
            return redirect()->back()->with('error', 'No orders selected for export.');
        }

        if ($type === 'pdf') {
            $ordersGrouped = Order::whereIn('orders.id', $ids)
                ->select(
                    'orders.invoice_id',
                    'courses.title as course_title',
                    'courses.price as course_price',
                    'courses.discount as course_discount',
                    'instructor.name as instructor',
                    'users.name as student',
                    'orders.paid_amount as paid_amount',
                    'orders.currency',
                    'users.email',
                    'orders.id as order_id',
                    'orders.created_at as created_at'
                )
                ->leftJoin('order_items', 'order_items.order_id', '=', 'orders.id')
                ->leftJoin('courses', 'courses.id', '=', 'order_items.course_id')
                ->leftJoin('users', 'users.id', '=', 'orders.buyer_id')
                ->leftJoin('users as instructor', 'instructor.id', '=', 'courses.instructor_id')
                ->orderBy('orders.invoice_id')
                ->get()
                ->groupBy('order_id'); // group by invoice

            $pdf = PDF::loadView('admin.order.partials.export-invoice-pdf', [
                'groupedOrders' => $ordersGrouped
            ]);


            return $pdf->stream('multiple-invoices.pdf');
        }

        // default excel
        return Excel::download(new CourseOrderExport($ids), 'selected-orders.xlsx');
    }
}
