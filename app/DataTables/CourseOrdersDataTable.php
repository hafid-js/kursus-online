<?php

namespace App\DataTables;

use App\Models\CourseOrder;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CourseOrdersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    private function filterBuyerColumn($query, $keyword): void
    {
        $query->where('users.name', 'like', "%{$keyword}%")
            ->orWhere('users.email', 'like', "%{$keyword}%");
    }
    private function filterCourseColumn($query, $keyword): void
    {
        $query->where('courses.title', 'like', "%{$keyword}%")
            ->orWhere('instructor.name', 'like', "%{$keyword}%");
    }
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $dataTable = new EloquentDataTable($query);
        $dataTable
            ->filterColumn('course', fn($query, $keyword) => $this->filterCourseColumn($query, $keyword))
            ->filterColumn('user_name', fn($query, $keyword) => $this->filterBuyerColumn($query, $keyword));

        // order column for title course
        $dataTable->orderColumn('course', function ($query, $order) {
            $query->orderBy('courses.title', $order);
        });

        // order column for user/buyer name
        $dataTable->orderColumn('user_name', function ($query, $order) {
            $query->orderBy('users.name', $order);
        });

        return $dataTable
            ->addColumn('checkbox', function ($row) {
                return '<input type="checkbox" class="order-checkbox form-check-input m-0 align-middle" value="' . $row->id . '">';
            })
            ->editColumn('invoice_id', function ($row) {
                return '#' . strtoupper($row->invoice_id);
            })
            ->editColumn('discount', function ($row) {
                return $row->discount . '%';
            })
            ->addColumn('user_name', function ($row) {
                $avatar = '';

                if (!empty($row->user_image)) {
                    $avatar = '<span class="avatar avatar-2 me-2" style="background-image: url(' . asset($row->user_image) . ')"></span>';
                } else {
                    $initials = getUserInitials($row->user_name);
                    $avatar = '<span class="avatar avatar-2 me-2 bg-primary-lt text-primary fw-bold">' . $initials . '</span>';
                }

                return '
        <div class="d-flex py-1 align-items-center">
            ' . $avatar . '
            <div class="flex-fill">
                <div class="font-weight-medium">' . e($row->user_name) . '</div>
                <div class="font-weight-medium">
                    <div class="text-secondary">
                        <a href="#" class="text-reset">' . e($row->user_email) . '</a>
                    </div>
                </div>
            </div>
        </div>
    ';
            })
            ->addColumn('course', function ($row) {
                $avatar = '';

                if (!empty($row->course_thumbnail)) {
                    $avatar = '<span class="avatar avatar-2 me-2" style="background-image: url(' . asset($row->course_thumbnail) . ')"></span>';
                } else {
                    $initials = getUserInitials($row->course_title);
                    $avatar = '<span class="avatar avatar-2 me-2 bg-primary-lt text-primary fw-bold">' . $initials . '</span>';
                }

                // Cek if > 1 course in invoice
                $showButton = ($row->items_count > 1);

                $buttonAnother = '';
                if ($showButton) {
                    $buttonAnother = '
            <a href="#" class="btn btn-sm ms-2 show-order-courses" data-order-id="' . $row->id . '">
                <i class="ti ti-arrow-down"></i> More
            </a>
        ';
                }

                return '
        <div class="d-flex py-1 align-items-center">
            ' . $avatar . '
            <div class="flex-fill">
                            <span>' . e($row->course_title) . '</span>
 <div class="font-weight-medium d-flex justify-content-between align-items-center">
                <a href="#" class="text-reset ">' . e($row->instructor_name) . '</a>
                    ' . $buttonAnother . '
                        </div>
            </div>
        </div>
    ';
            })

            ->editColumn('status', function ($row) {
                return $row->status ? '<span class="badge bg-lime text-lime-fg">Approved</span>' : ' <span class="badge bg-yellow text-yellow-fg">Pending</span>';
            })
            ->editColumn('created_at', function ($row) {
                return format_to_date($row->created_at);
            })
            ->addColumn('action', function ($row) {
                return '<a data-order-id="' . $row->id . '" class="btn-sm btn-primary show-order-invoice">
                 <i class="ti ti-eye"></i>
             </a>';
            })
            ->rawColumns(['checkbox', 'action', 'user_name', 'created_at', 'status', 'course', 'discount'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */

    protected $instructorId = null;

    public function setInstructorId($id)
    {
        $this->instructorId = $id;
        return $this;
    }

    public function query(Order $model): QueryBuilder
    {
        $query = $model->newQuery()
            ->select(
                'orders.invoice_id',
                DB::raw('MIN(orders.id) as id'),
                DB::raw('SUM(courses.price) as total_amount'),
                DB::raw('SUM(courses.price - (courses.price * COALESCE(courses.discount, 0) / 100)) as paid_amount'),
                DB::raw('MIN(orders.currency) as currency'),
                DB::raw('MIN(users.name) as user_name'),
                DB::raw('MIN(users.image) as user_image'),
                DB::raw('MIN(users.email) as user_email'),
                DB::raw('GROUP_CONCAT(DISTINCT courses.title SEPARATOR ", ") as course_titles'),
                DB::raw('MIN(instructor.name) as instructor_name'),
                DB::raw('COUNT(order_items.id) as items_count'),
                DB::raw('MIN(orders.id) as order_id'),
                DB::raw('MIN(courses.thumbnail) as course_thumbnail'),
                DB::raw('MIN(courses.title) as course_title'),
                DB::raw('IFNULL(MIN(courses.discount), 0) as discount'),
                DB::raw('MIN(orders.status) as status'),
                DB::raw('MIN(orders.created_at) as created_at')
            )
            ->leftJoin('users', 'users.id', '=', 'orders.buyer_id')
            ->leftJoin('order_items', 'order_items.order_id', '=', 'orders.id')
            ->leftJoin('courses', 'courses.id', '=', 'order_items.course_id')
            ->leftJoin('users as instructor', 'instructor.id', '=', 'courses.instructor_id')
            ->groupBy('orders.invoice_id');

        // just for filter if instructorId is not null
        if (!is_null($this->instructorId)) {
            $query->where('courses.instructor_id', $this->instructorId);
        }

        return $query;
    }



    // public function query(Order $model): QueryBuilder
    // {

    //     return $model->newQuery()
    //         ->select(
    //             'orders.invoice_id',
    //             DB::raw('MIN(orders.id) as id'),
    //             DB::raw('SUM(courses.price) as total_amount'),
    //             DB::raw('SUM(courses.price - (courses.price * COALESCE(courses.discount, 0) / 100)) as paid_amount'),
    //             DB::raw('MIN(orders.currency) as currency'),
    //             DB::raw('MIN(users.name) as user_name'),
    //             DB::raw('MIN(users.image) as user_image'),
    //             DB::raw('MIN(users.email) as user_email'),
    //             DB::raw('GROUP_CONCAT(DISTINCT courses.title SEPARATOR ", ") as course_titles'),
    //             DB::raw('MIN(instructor.name) as instructor_name'),
    //             DB::raw('COUNT(order_items.id) as items_count'),
    //             DB::raw('MIN(orders.id) as order_id'),
    //             DB::raw('MIN(courses.thumbnail) as course_thumbnail'),
    //             DB::raw('MIN(courses.title) as course_title'),
    //             DB::raw('IFNULL(MIN(courses.discount), 0) as discount'),
    //             DB::raw('MIN(orders.status) as status'),
    //             DB::raw('MIN(orders.created_at) as created_at')
    //         )
    //         ->leftJoin('users', 'users.id', '=', 'orders.buyer_id')
    //         ->leftJoin('order_items', 'order_items.order_id', '=', 'orders.id')
    //         ->leftJoin('courses', 'courses.id', '=', 'order_items.course_id')
    //         ->leftJoin('users as instructor', 'instructor.id', '=', 'courses.instructor_id')
    //         ->groupBy('orders.invoice_id');
    // }

    /**
     * Optional method if you want to use the html builder.
     */
    // public function html(): HtmlBuilder
    // {
    //     return $this->builder()
    //         ->setTableId('courseorders-table')
    //         ->columns($this->getColumns())
    //         ->minifiedAjax()
    //         //->dom('Bfrtip')
    //         ->orderBy(1)
    //         ->selectStyleSingle()
    //         ->parameters([
    //             'pageLength' => 10,
    //             'lengthChange' => false,
    //             'paging' => true,
    //             'info' => true,
    //             'searching' => true,
    //             'dom' => 'Brt',
    //             'initComplete' => "function() {
    //             $('.dt-buttons').appendTo('#my-custom-dt-buttons').addClass('btn-group');
    //         }",
    //         ])
    //         ->buttons([
    //             ['extend' => 'excel', 'className' => 'btn btn-sm btn-success me-2', 'text' => '<i class=\"ti ti-file-export\"></i> Excel'],
    //             ['extend' => 'csv', 'className' => 'btn btn-sm btn-info me-2', 'text' => '<i class=\"ti ti-file-text\"></i> CSV'],
    //             ['extend' => 'pdf', 'className' => 'btn btn-sm btn-danger me-2', 'text' => '<i class=\"ti ti-file-pdf\"></i> PDF'],
    //             ['extend' => 'print', 'className' => 'btn btn-sm btn-primary me-2', 'text' => '<i class=\"ti ti-printer\"></i> Print'],
    //             ['extend' => 'reset', 'className' => 'btn btn-sm btn-warning me-2', 'text' => 'Reset'],
    //             ['extend' => 'reload', 'className' => 'btn btn-sm btn-secondary', 'text' => 'Reload'],
    //         ]);;
    // }


    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('courseorders-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->parameters([
                'pageLength' => 10,
                'lengthChange' => false,
                'paging' => true,
                'info' => true,
                'searching' => true,
                'dom' => 'rt',
            ])
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('checkbox')
                ->title('<input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all Orders" id="select-all">')
                ->exportable(false)
                ->printable(false)
                ->orderable(false)
                ->searchable(false)
                ->width(30)
                ->addClass('text-center'),

            Column::computed('invoice_id')
                ->title('<span class="d-flex justify-content-start">Invoice</span>')
                ->searchable(true)
                ->orderable(false)
                ->escape(false),

            Column::computed('course')
                ->title('<span class="table-sort d-flex justify-content-start">Course</span>')
                ->searchable(true)
                ->orderable(true)
                ->escape(false),

            Column::computed('user_name')
                ->title('<span class="table-sort d-flex justify-content-start">Student</span>')
                ->searchable(true)
                ->orderable(true)
                ->escape(false),

            Column::make('total_amount')
                ->title('<span class="table-sort d-flex justify-content-start">Total Amount</span>'),

            Column::computed('discount')
                ->title('<span class="table-sort d-flex justify-content-start">Discount</span>'),

            Column::make('paid_amount')
                ->title('<span class="table-sort d-flex justify-content-start">Paid Amount</span>')
                ->orderable(true),

            Column::make('currency'),

            Column::computed('status')
                ->title('<span class="table-sort d-flex justify-content-start">Status</span>')
                ->searchable(true)
                ->orderable(true),

            Column::computed('created_at')
                ->title('<span class="table-sort d-flex justify-content-start">Order Date</span>')
                ->orderable(true),

            Column::computed('action')

        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'CourseOrders_' . date('YmdHis');
    }
}
