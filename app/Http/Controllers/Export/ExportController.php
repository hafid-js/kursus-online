<?php

namespace App\Http\Controllers\Export;

use App\Exports\CourseOrderExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function courseExportOrders(Request $request)
    {
        $ids = explode(',', $request->ids ?? '');
        return Excel::download(new CourseOrderExport($ids), 'course_orders.xlsx');
    }

    public function exportSelected(Request $request)
{
    $ids = $request->input('ids', []);
    $type = $request->query('type', 'excel');

    if (empty($ids)) {
        return redirect()->back()->with('error', 'No orders selected for export.');
    }

    $export = new CourseOrderExport($ids);

    if ($type === 'pdf') {
        // contoh kalau mau export pdf
        return Excel::download($export, 'selected-orders.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }

    // default excel
    return Excel::download($export, 'selected-orders.xlsx');
}

}
