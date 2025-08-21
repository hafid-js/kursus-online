<?php

namespace App\DataTables;

use App\Models\Course;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CourseDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */


    protected $instructorId = null;

    public function setInstructorId($id)
    {
        $this->instructorId = $id;
        return $this;
    }

    private function filterCourseColumn($query, $keyword): void
    {
        $query->where('title', 'like', "%{$keyword}%");
        $query->where('instructor.name', 'like', "%{$keyword}%");
    }

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {

        $dataTable = new EloquentDataTable($query);
        $dataTable
            ->filterColumn('title', function ($query, $keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('courses.title', 'like', "%{$keyword}%")
                        ->orWhere('instructor.name', 'like', "%{$keyword}%");
                });
            });



        // order column for title course
        $dataTable->orderColumn('title', function ($query, $order) {
            $query->orderBy('title', $order);
        });

        return $dataTable
            ->addIndexColumn()
            ->editColumn('title', function ($row) {
                return '<div class="d-flex py-1 align-items-center">
                                                                <span class="avatar avatar-2 me-2"
                                                                    style="background-image: url(' . asset($row->thumbnail) . ')"></span>
                                                            <div class="flex-fill">
                                                                <div class="font-weight-medium">
                                                                    ' . $row->title . '</div>
                                                                    <div class="font-weight-medium">
                                                                        <div class="text-secondary">
                                                                            <a href="#"
                                                                                class="text-reset">' . $row->instructor->name . '</a>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                        </div>';
            })
            ->editColumn('price', function ($row) {
                return $row->price;
            })
            ->editColumn('discount', function ($row) {
                return $row->discount ?? 0 . '%';
            })
            ->editColumn('created_at', function ($row) {
                return format_to_date($row->created_at);
            })
            ->editColumn('status', function ($row) {
                return $row->status ? '<span class="badge bg-lime text-lime-fg">Approved</span>' : ' <span class="badge bg-yellow text-yellow-fg">Pending</span>';
            })
            ->editColumn('is_approved', function ($row) {
                return '<select name="" class="form-control update-approval-status" data-id="' . $row->id . '">
    <option value="pending" ' . ($row->is_approved == 'pending' ? 'selected' : '') . '>Pending</option>
    <option value="approved" ' . ($row->is_approved == 'approved' ? 'selected' : '') . '>Approved</option>
    <option value="rejected" ' . ($row->is_approved == 'rejected' ? 'selected' : '') . '>Rejected</option>
</select>';
            })
            ->addColumn('action', function ($row) {
                return ' <a href="' . route('admin.courses.edit', ['id' => $row->id, 'step' => 1]) . '"
                                                            class="text-blue">
                                                            <i class="ti ti-edit"></i>
                                                        </a>';
            })
            ->rawColumns(['title', 'price', 'discount', 'created_at', 'status', 'is_approved', 'action'])
            ->setRowId('id');
    }


    /**
     * Get the query source of dataTable.
     */

    public function query(Course $model): QueryBuilder
    {
        $query = $model->newQuery()->leftJoin('users as instructor', 'instructor.id', '=', 'courses.instructor_id')
            ->select('courses.*', 'instructor.name as instructor_name');;

        if ($this->instructorId !== null) {
            $query->where('instructor_id', $this->instructorId);
        }

        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('courseo-table')
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
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
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
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Course_' . date('YmdHis');
    }
}
