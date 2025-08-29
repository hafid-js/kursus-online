<?php

namespace App\DataTables\Frontend\Instructor;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CourseEnrolledDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query results from query() method
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $dataTable = new EloquentDataTable($query);

        $dataTable->filterColumn('title', function ($query, $keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('courses.title', 'like', "%{$keyword}%")
                    ->orWhere('instructors.name', 'like', "%{$keyword}%");
            });
        });

        return $dataTable
            ->addIndexColumn()
            ->editColumn('image', function ($row) {
                return '<div class="image_category"><img src="' . asset($row->course?->thumbnail) . '" alt="img" class="img-fluid w-100"></div>';
            })
            ->editColumn('title', function ($row) {
                $course = $row->course;

                $avgRating = $course?->reviews()->avg('rating') ?? 0;
                $stars = '';
                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= $avgRating) {
                        $stars .= '<i class="fas fa-star"></i>';
                    } else {
                        $stars .= '<i class="far fa-star"></i>';
                    }
                }

                $titleLink = '<a class="title" href="' . route('instructor.course-player.index', $course?->slug) . '">' . e($course?->title) . '</a>';

                $instructorName = '<div class="text-muted">By ' . e($course?->instructor?->name) . '</div>';

                $watchedLessonCount = \App\Models\WatchHistory::where([
                    'user_id' => auth()->id(),
                    'course_id' => $course?->id,
                    'is_completed' => 1,
                ])->count();

                $lessonCount = $course?->lessons()->count() ?? 0;

                $certificateButton = '';
                if ($lessonCount > 0 && $lessonCount == $watchedLessonCount) {
                    $certificateButton = '<a target="_blank" href="' . route('instructor.certificate.download', $course?->id) . '" class="btn btn-sm btn-warning">Download Certificate</a>';
                }

                return '<p class="rating">' . $stars . ' <span>(' . number_format($avgRating, 1) . ' Rating)</span></p>' .
                    $titleLink .
                    $instructorName .
                    $certificateButton;
            })


            ->editColumn('action', function ($row) {
                return '<a class="btn btn-primary" href="' . route('instructor.course-player.index', $row->course?->slug) . '"><i class="fas fa-eye"></i> Watch Course</a>';
            })
            ->rawColumns(['image', 'title', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(OrderItem $model): QueryBuilder
    {
        $query = $model->newQuery()
            ->join('courses', 'order_items.course_id', '=', 'courses.id')
            ->join('users as instructors', function ($join) {
                $join->on('courses.instructor_id', '=', 'instructors.id')
                    ->where('instructors.role', 'instructor');
            })
            ->whereHas('order', function ($q) {
                $q->where('buyer_id', user()->id);
            });
        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('courseenrolled-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            // ->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->parameters([
                'pageLength' => 8,
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
                ->width(10)
                ->orderable(false),
            Column::computed('image')
                ->title('<span>IMAGE</span>')
                ->searchable(false)
                ->orderable(false)
                ->escape(false),

            Column::computed('title')
                ->title('<span>COURSE</span>')
                ->searchable(true)
                ->orderable(false)
                ->escape(false),

            Column::computed('action')
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
        return 'CourseEnrolled_' . date('YmdHis');
    }
}
