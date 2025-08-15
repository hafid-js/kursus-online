<?php

namespace App\DataTables;

use App\Models\CourseReview;
use App\Models\Review;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CourseReviewsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $dataTable = new EloquentDataTable($query);

        $dataTable->orderColumn('course_title', function ($query, $order) {
            $query->orderBy('courses.title', $order);
        });

        $dataTable->orderColumn('user_name', function ($query, $order) {
            $query->orderBy('users.name', $order);
        });

        return $dataTable
            ->addIndexColumn()
            ->addColumn('course_title', fn($row) => $row->course?->title ?? '-')
            ->addColumn('user_name', function ($row) {
                $avatar = '';

                if (!empty($row->user->image)) {
                    $avatar = '<span class="avatar avatar-2 me-2" style="background-image: url(' . asset($row->user->image) . ')"></span>';
                } else {
                    $initials = getUserInitials($row->user->name);
                    $avatar = '<span class="avatar avatar-2 me-2 bg-primary-lt text-primary fw-bold">' . $initials . '</span>';
                }

                return '
        <div class="d-flex py-1 align-items-center">
            ' . $avatar . '
            <div class="flex-fill">
                <div class="font-weight-medium">' . e($row->user->name) . '</div>
                <div class="font-weight-medium">
                    <div class="text-secondary">
                        <a href="#" class="text-reset">' . e($row->user->email) . '</a>
                    </div>
                </div>
            </div>
        </div>
    ';
            })

            ->filterColumn('course_title', function ($query, $keyword) {
                $query->where('courses.title', 'like', "%{$keyword}%");
            })
            ->filterColumn('user_name', function ($query, $keyword) {
                $query->where('users.name', 'like', "%{$keyword}%");
            })
            ->editColumn('status', function ($row) {
                return $row->status ? '<span class="badge bg-lime text-lime-fg">Approved</span>' : ' <span class="badge bg-yellow text-yellow-fg">Pending</span>';
            })
            ->editColumn('created_at', function ($row) {
                return format_to_date($row->created_at);
            })
            ->editColumn('review', function ($row) {
                return '<a class="show-review" data-review-id="' . $row->id . '"><i class="ti ti-eye"></i></a>';
            })
            ->editColumn('status_form', function ($row) {
                $csrf = csrf_token();
                $selectedPending = $row->status == 0 ? 'selected' : '';
                $selectedApproved = $row->status == 1 ? 'selected' : '';

                return '
            <form action="' . route('admin.reviews.update', $row->id) . '" method="POST">
                <input type="hidden" name="_token" value="' . $csrf . '">
                <input type="hidden" name="_method" value="PUT">
                <select name="status" class="form-control" onchange="this.form.submit()">
                    <option value="0" ' . $selectedPending . '>Pending</option>
                    <option value="1" ' . $selectedApproved . '>Approved</option>
                </select>
            </form>';
            })
            ->addColumn('action', function ($row) {
                return '
            <a href="' . route('admin.reviews.destroy', $row->id) . '" class="text-red delete-item">
                <i class="ti ti-trash"></i>
            </a>';
            })
            ->rawColumns(['course_title', 'user_name', 'status', 'review', 'status_form', 'action'])
            ->setRowId('id');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Review $model): QueryBuilder
    {
        return $model->newQuery()
            ->select('reviews.*', 'users.name as user_name', 'courses.title as course_title')
            ->leftJoin('users', 'users.id', '=', 'reviews.user_id')
            ->leftJoin('courses', 'courses.id', '=', 'reviews.course_id')
            ->with(['user:id,name,email,image', 'course:id,title']);
    }


    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('reviews')
            ->columns($this->getColumns())
            ->minifiedAjax()
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
            Column::computed('course_title')
                ->title('<span class="table-sort d-flex justify-content-start">Course</span>')
                ->searchable(true)
                ->orderable(true)
                ->escape(false),
            Column::computed('user_name')
                ->title('<span class="table-sort d-flex justify-content-start">Student</span>')
                ->searchable(true)
                ->orderable(true)
                ->escape(false),
            Column::make('rating')
                ->title('<span class="table-sort d-flex justify-content-start">Rating</span>')
                ->orderable(true)
                ->escape(false),
            Column::make('review')
                ->title('<span class="d-flex justify-content-start">Detail Review</span>')
                ->orderable(false)
                ->escape(false),
            Column::make('status')
                ->title('<span class="table-sort d-flex justify-content-start">Status</span>')
                ->orderable(true)
                ->escape(false),
            Column::make('created_at')
                ->title('<span class="table-sort d-flex justify-content-start" colspan="2">Created At</span>')
                ->orderable(true)
                ->escape(false),
            Column::computed('status_form')->title(''),
            Column::computed('action')->title('Action'),

        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'CourseReviews_' . date('YmdHis');
    }
}
