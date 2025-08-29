<?php

namespace App\DataTables\Frontend\Instructor;

use App\Models\CourseChapterLession;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\WatchHistory;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class StudentsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query results from query() method
     */
    protected $instructorId;

    public function setInstructorId($id)
    {
        $this->instructorId = $id;

        return $this;
    }

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $dataTable = new EloquentDataTable($query);

        $dataTable->filterColumn('name', function ($query, $keyword) {
            $query->whereHas('order.customer', function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%");
            });
        });

        return $dataTable
            ->editColumn('name', function ($row) {
                $image = $row->order->customer->image ? asset($row->order->customer->image) : url('frontend/assets/images/image-profile.png');

                return '<div class="form-check form-check-inline">
                    <input class="student-checkbox form-check-input" type="checkbox" value="' . $row->id . '">
                     </div><div class="img"><img src="' . $image . '" alt="row" class="img-fluid w-100"></div>'
                    . '<a href="#">' . $row->order->customer->name . '</a>';
            })
            ->editColumn('created_at', function ($row) {
                return '<p class="date">' . $row->order->created_at->format('Y-m-d') . '</p>';
            })
            ->editColumn('title', function ($row) {
                return '<p class="location">' . $row->course->title . '</p>';
            })
            ->editColumn('progress', function ($row) {
                $courseId = $row->course_id;
                $userId = $row->order->customer->id;

                $lessonCount = CourseChapterLession::where('course_id', $courseId)->count();

                $watchedCount = WatchHistory::where([
                    'user_id' => $userId,
                    'course_id' => $courseId,
                    'is_completed' => 1,
                ])->count();

                $progressPercent = $lessonCount > 0 ? round(($watchedCount / $lessonCount) * 100) : 0;

                return "<p>{$watchedCount} of {$lessonCount} ({$progressPercent}%)</p>";
            })
            ->rawColumns(['name', 'created_at', 'title', 'progress', 'action'])
             ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        $instructorId = $this->instructorId;

        return OrderItem::query()
            ->whereHas('course', function (Builder $q) use ($instructorId) {
                $q->where('instructor_id', $instructorId);
            })
            ->with(['course', 'order.customer']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('students-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    // ->dom('Bfrtip')
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
            Column::make('name')
                    ->title('<span><input class="form-check-input" type="checkbox" id="select-all" value="option1"></span><span class="img">STUDENT</span>')
                    ->searchable(true)
                    ->orderable(false)
                    ->escape(false),

            Column::computed('created_at')
            ->title('<span class="date">ENROLLED</span>')
            ->searchable(false)
            ->orderable(false)
            ->escape(false),

            Column::computed('title')
            ->title('<span class="location">COURSE</span>')
            ->searchable(false)
            ->orderable(false)
            ->escape(false),

            Column::computed('progress')
            ->title('<span class="progres">PROGRESS</span>')
            ->searchable(false)
            ->orderable(false)
            ->escape(false),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Students_' . date('YmdHis');
    }
}