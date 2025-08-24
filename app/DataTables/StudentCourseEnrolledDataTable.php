<?php

namespace App\DataTables;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class StudentCourseEnrolledDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    private function filterBuyerColumn($query, $keyword): void
    {
        $query->whereHas('order.customer', function ($q) use ($keyword) {
            $q->where('name', 'like', "%{$keyword}%")
                ->orWhere('email', 'like', "%{$keyword}%");
        });
    }
    private function filterCourseColumn($query, $keyword): void
    {
        $query->whereHas('course', function ($q) use ($keyword) {
            $q->where('title', 'like', "%{$keyword}%")
                ->orWhereHas('instructor', function ($q2) use ($keyword) {
                    $q2->where('name', 'like', "%{$keyword}%");
                });
        });
    }
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $dataTable = new EloquentDataTable($query);

        $dataTable
            ->filterColumn('course', fn($query, $keyword) => $this->filterCourseColumn($query, $keyword))
            ->filterColumn('name', fn($query, $keyword) => $this->filterBuyerColumn($query, $keyword));

        // order column for title course
        $dataTable->orderColumn('course', function ($query, $order) {
            $query->orderBy('courses.title', $order);
        });

        // order column for user/buyer name
        $dataTable->orderColumn('name', function ($query, $order) {
            $query->orderBy('users.name', $order);
        });


        return $dataTable
            ->editColumn('paid_amount', function ($row) {
                return $row->price;
            })
            ->editColumn('price', function ($row) {
                return $row->course->price;
            })
            ->addColumn('checkbox', function ($row) {
                return '<input type="checkbox" class="order-checkbox form-check-input m-0 align-middle" value="' . $row->id . '">';
            })
            ->editColumn('invoice_id', function ($row) {
                return '#' . strtoupper($row->order->invoice_id);
            })
            ->editColumn('discount', function ($row) {
                return ($row->course->discount ?? 0) . '%';
            })
            ->addColumn('name', function ($row) {
                $avatar = '';

                if (!empty($row->order->customer->image)) {
                    $avatar = '<span class="avatar avatar-2 me-2" style="background-image: url(' . asset($row->order->customer->image) . ')"></span>';
                } else {
                    $initials = getUserInitials($row->order->customer->name);
                    $avatar = '<span class="avatar avatar-2 me-2 bg-primary-lt text-primary fw-bold">' . $initials . '</span>';
                }

                return '
        <div class="d-flex py-1 align-items-center">
            ' . $avatar . '
            <div class="flex-fill">
                <div class="font-weight-medium">' . e($row->order->customer->name) . '</div>
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

                if (!empty($row->course->thumbnail)) {
                    $avatar = '<span class="avatar avatar-2 me-2" style="background-image: url(' . asset($row->course->thumbnail) . ')"></span>';
                } else {
                    $initials = getUserInitials($row->course->title);
                    $avatar = '<span class="avatar avatar-2 me-2 bg-primary-lt text-primary fw-bold">' . $initials . '</span>';
                }

                return '
        <div class="d-flex py-1 align-items-center">
            ' . $avatar . '
            <div class="flex-fill">
                            <span>' . e($row->course->title) . '</span>
 <div class="font-weight-medium d-flex justify-content-between align-items-center">
                <a href="#" class="text-reset ">' . e($row->course->instructor->name) . '</a>
                        </div>
            </div>
        </div>
    ';
            })

            ->editColumn('currency', function ($row) {
                return $row->order->currency;
            })

            ->editColumn('status', function ($row) {
                return $row->order->status ? '<span class="badge bg-lime text-lime-fg">Approved</span>' : ' <span class="badge bg-yellow text-yellow-fg">Pending</span>';
            })
            ->editColumn('created_at', function ($row) {
                return format_to_date($row->created_at);
            })
            ->rawColumns(['checkbox', 'name', 'created_at', 'status', 'course', 'discount'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */

    protected $instructorId = null;
    protected $studentId = null;

    public function setInstructorId($id)
    {
        $this->instructorId = $id;
        return $this;
    }
    public function setStudentId($id)
    {
        $this->studentId = $id;
        return $this;
    }

    public function query(OrderItem $model): QueryBuilder
    {
        $query = $model->newQuery()
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->join('courses', 'courses.id', '=', 'order_items.course_id')
            ->with(['order.customer', 'course.instructor'])

            ->whereHas('course', function ($q) {
                if ($this->instructorId !== null) {
                    $q->where('instructor_id', $this->instructorId);
                }
            });

        if ($this->studentId !== null) {
            $query->whereHas('order', function ($q) {
                $q->where('buyer_id', $this->studentId);
            });
        } else {
            $query->orWhereHas('order', function ($q) {
                if ($this->instructorId !== null) {
                    $q->where('instructor_id', $this->instructorId);
                }
            });
        }

        return $query->select('order_items.*', 'orders.buyer_id', 'courses.id as course_id', 'courses.title as course_name', 'orders.id as order_id');
    }




    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        $route = '';
        if ($this->studentId) {
            $route = route('admin.student.course-enrolled', ['id' => $this->studentId]);
        } elseif ($this->instructorId) {
            $route = route('admin.instructor.course-student-enrolled', ['id' => $this->instructorId]);
        }
        return $this->builder()
            ->setTableId('studentcourseenrolled-table')
            ->columns($this->getColumns())
            ->minifiedAjax($route)
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
                Button::make('reload'),
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
                ->width(30)
                ->addClass('text-center'),

            Column::computed('invoice_id')
                ->title('<span class="d-flex justify-content-start">Invoice</span>')
                ->searchable(false)
                ->orderable(false)
                ->escape(false),

            Column::computed('course')
                ->title('<span class="table-sort d-flex justify-content-start">Course</span>')
                ->searchable(true)
                ->orderable(true)
                ->escape(false),

            Column::computed('name')
                ->title('<span class="table-sort d-flex justify-content-start">Student</span>')
                ->searchable(true)
                ->orderable(true)
                ->escape(false),

            Column::make('price')
                ->title('<span class="table-sort d-flex justify-content-start">Course Price</span>'),

            Column::computed('discount')
                ->title('<span class="table-sort d-flex justify-content-start">Discount</span>')
                ->searchable(false)
                ->orderable(true),

            Column::make('paid_amount')
                ->title('<span class="table-sort d-flex justify-content-start">Paid Amount</span>')
                ->searchable(false)
                ->orderable(true),

            Column::computed('currency')
                ->title('<span class="table-sort d-flex justify-content-start">Currency</span>')
                ->orderable(true),
            Column::computed('status')
                ->title('<span class="table-sort d-flex justify-content-start">Status</span>')
                ->searchable(false)
                ->orderable(true),

            Column::computed('created_at')
                ->title('<span class="table-sort d-flex justify-content-start">Order Date</span>')
                ->searchable(false)
                ->orderable(true),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'StudentCourseEnrolled_' . date('YmdHis');
    }
}
