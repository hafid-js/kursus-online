<?php

namespace App\DataTables;

use App\Models\CourseOrder;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
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
            ->addIndexColumn()
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
                    $initials = getUserInitials($row->course_name);
                    $avatar = '<span class="avatar avatar-2 me-2 bg-primary-lt text-primary fw-bold">' . $initials . '</span>';
                }

                return '
        <div class="d-flex py-1 align-items-center">
            ' . $avatar . '
            <div class="flex-fill">
                <div class="font-weight-medium">' . e($row->course_title) . '</div>
                <div class="font-weight-medium">
                    <div class="text-secondary">
                        <a href="#" class="text-reset">' . e($row->instructor_name) . '</a>
                    </div>
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
                return '<a data-order-id="' . $row->id . '" class="btn-sm btn-primary show-order">
                 <i class="ti ti-eye"></i>
             </a>';
            })
            ->rawColumns(['action', 'user_name', 'created_at', 'status', 'course'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Order $model): QueryBuilder
    {
        return $model->newQuery()
            ->select('orders.*', 'instructor.name as instructor_name', 'users.name as user_name', 'users.image as user_image', 'users.email as user_email', 'courses.title as course_title', 'courses.thumbnail as course_thumbnail')
            ->leftJoin('users', 'users.id', '=', 'orders.buyer_id')
            ->leftJoin('order_items', 'order_items.order_id', '=', 'orders.id')
            ->leftJoin('courses', 'courses.id', '=', 'order_items.course_id')
            ->leftJoin('users as instructor', 'instructor.id', '=', 'courses.instructor_id');
    }

    /**
     * Optional method if you want to use the html builder.
     */
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
            Column::computed('DT_RowIndex')
                ->title('No.')
                ->searchable(false)
                ->orderable(false)
                ->width(80),
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
            Column::make('paid_amount')
                ->title('<span class="table-sort d-flex justify-content-start">Paid Amount</span>')
                ->orderable(true),
            Column::make('currency'),
            Column::computed('status')
                ->title('<span class="table-sort d-flex justify-content-start">Status</span>')
                ->searchable(true)
                ->orderable(true),
            Column::computed('created_at')
                ->title('<span class="table-sort d-flex justify-content-start">Date</span>')
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
