<?php

namespace App\DataTables;

use App\Models\Course;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CourseDataTable extends DataTable
{
    protected $instructorId;

    public function setInstructorId($id)
    {
        $this->instructorId = $id;

        return $this;
    }

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $dataTable = new EloquentDataTable($query);

        $dataTable->filterColumn('title', function ($query, $keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('courses.title', 'like', "%{$keyword}%")
                  ->orWhere('instructor.name', 'like', "%{$keyword}%");
            });
        });

        $dataTable->orderColumn('title', function ($query, $order) {
            $query->orderBy('title', $order);
        });

        return $dataTable
            ->addIndexColumn()
            ->editColumn('title', function ($row) {
                return '
                    <div class="d-flex py-1 align-items-center">
                        <span class="avatar avatar-2 me-2" style="background-image: url(' . asset($row->thumbnail) . ')"></span>
                        <div class="flex-fill">
                            <div class="font-weight-medium">' . $row->title . '</div>
                            <div class="text-secondary">
                                <a href="#" class="text-reset">' . $row->instructor->name . '</a>
                            </div>
                        </div>
                    </div>
                ';
            })
            ->editColumn('price', fn ($row) => $row->price)
            ->editColumn('discount', fn ($row) => ($row->discount ?? 0) . '%')
            ->editColumn('created_at', fn ($row) => format_to_date($row->created_at))
            ->editColumn('status', function ($row) {
                return match ($row->status) {
                    'active' => '<span class="badge bg-lime text-lime-fg">Active</span>',
                    'inactive' => '<span class="badge bg-yellow text-yellow-fg">Inactive</span>',
                    'draft' => '<span class="badge bg-secondary text-secondary-fg">Draft</span>',
                    default => '<span class="badge bg-secondary">Unknown</span>',
                };
            })
            ->editColumn('is_approved', function ($row) {
                $status = $row->is_approved;

                $validationClass = match ($status) {
                    'approved' => 'is-valid',
                    'pending' => 'is-pending',
                    default => 'is-invalid',
                };

                return '
                    <select class="form-control update-approval-status ' . $validationClass . '" data-id="' . $row->id . '">
                        <option value="pending" ' . ('pending' === $status ? 'selected' : '') . '>Pending</option>
                        <option value="approved" ' . ('approved' === $status ? 'selected' : '') . '>Approved</option>
                        <option value="rejected" ' . ('rejected' === $status ? 'selected' : '') . '>Rejected</option>
                    </select>
                ';
            })
            ->addColumn('action', fn ($row) => '
                <a href="' . route('admin.courses.edit', ['id' => $row->id, 'step' => 1]) . '" class="text-blue">
                    <i class="ti ti-edit"></i>
                </a>
            ')
            ->rawColumns(['title', 'price', 'discount', 'created_at', 'status', 'is_approved', 'action'])
            ->setRowId('id');
    }

    public function query(Course $model): QueryBuilder
    {
        $query = $model->newQuery()
            ->leftJoin('users as instructor', 'instructor.id', '=', 'courses.instructor_id')
            ->select('courses.*', 'instructor.name as instructor_name')
            ->where('courses.status', '!=', 'draft');

        if (null !== $this->instructorId) {
            $query->where('instructor_id', $this->instructorId);
        }

        return $query;
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('course-table')
            ->columns($this->getColumns())
            ->minifiedAjax(
                $this->instructorId
                    ? route('admin.instructor.data-course', ['id' => $this->instructorId])
                    : ''
            )
            ->orderBy(1)
            ->selectStyleSingle()
            ->parameters([
                'pageLength' => 10,
                'lengthChange' => false,
                'paging' => true,
                'info' => true,
                'searching' => true,
                'dom' => 'rt',
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex')
                ->title('No')
                ->searchable(false)
                ->orderable(false),

            Column::computed('title', 'instructor_name')
                ->title('<span class="table-sort d-flex justify-content-start">Title</span>')
                ->searchable(true)
                ->orderable(true)
                ->escape(false),

            Column::make('price')
                ->title('<span class="table-sort d-flex justify-content-start">Price</span>'),

            Column::computed('discount')
                ->title('<span class="table-sort d-flex justify-content-start">Discount</span>')
                ->searchable(true)
                ->orderable(true)
                ->escape(false),

            Column::computed('created_at')
                ->title('<span class="table-sort d-flex justify-content-start">Created At</span>')
                ->orderable(true),

            Column::computed('status')
                ->title('<span class="table-sort d-flex justify-content-start">Status</span>')
                ->searchable(true)
                ->orderable(true),

            Column::computed('is_approved')
                ->title('<span class="table-sort d-flex justify-content-start">Approve</span>')
                ->searchable(true)
                ->orderable(true),

            Column::computed('action')
                ->title('Action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Course_' . date('YmdHis');
    }
}
