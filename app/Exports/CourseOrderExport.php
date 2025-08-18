<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CourseOrderExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $ids;

    public function __construct(array $ids)
    {
        $this->ids = $ids;
    }
    public function collection()
    {
        return Order::select(
            'orders.invoice_id',
            'courses.title as course_title',
            'instructor.name as instructor',
            'users.name as student',
            'courses.price as price',
            'orders.total_amount as total_amount',
            'orders.paid_amount as paid_amount',
            'orders.currency',
            'orders.status',
            'orders.created_at'
        )
        ->leftJoin('order_items', 'order_items.order_id', '=', 'orders.id')
        ->leftJoin('courses', 'courses.id', '=', 'order_items.course_id')
        ->leftJoin('users', 'users.id', '=', 'orders.buyer_id')
        ->leftJoin('users as instructor', 'instructor.id' ,'=', 'courses.instructor_id')
         ->when(!empty($this->ids), function ($q) {
            $q->whereIn('orders.id', $this->ids);
        })
        ->get();
    }

    public function headings(): array
    {
        return [
        'Invoice',
        'Course',
        'Instructor',
        'Total Amount',
        'Paid Amount',
        'Student',
        'Course Price',
        'Currency',
        'Status',
        'Order Date',
    ];
    }

    public function map($row): array
    {
        return [
            $row->invoice_id,
            $row->course_title,
            $row->instructor,
            $row->total_amount,
            $row->paid_amount,
            $row->student,
            $row->price,
            $row->currency,
            $row->status ? 'Approved' : 'Pending',
            format_to_date($row->created_at),
        ];
    }

    //  public function columnWidths(): array
    // {
    //     return [
    //         'A' => 15, // Invoice
    //         'B' => 30, // Course
    //         'C' => 25, // Student
    //         'D' => 15, // Total Amount
    //         'E' => 15, // Paid Amount
    //         'F' => 10, // Currency
    //         'G' => 15, // Status
    //         'H' => 20, // Date
    //     ];
    // }
}
