<?php

namespace App\DataTables\Frontend\Instructor;

use App\Models\Course;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CourseDataTable extends DataTable
{
    /**
     * Instructor ID filter.
     */
    protected $instructorId;

    public function setInstructorId($id)
    {
        $this->instructorId = $id;

        return $this;
    }

    /**
     * Build the DataTable class.
     */
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
            ->editColumn('thumbnail', function ($row) {
                return '
                    <div class="image_category">
                        <img src="' . asset($row->thumbnail) . '" alt="img" class="img-fluid w-100">
                    </div>';
            })
            ->editColumn('title', function ($row) {
                $averageRating = round(optional($row->reviews)->avg('rating'), 1) ?? 0;
                $stars = '';
                for ($i = 1; $i <= 5; ++$i) {
                    $stars .= $i <= $averageRating
                        ? '<i class="fas fa-star"></i>'
                        : '<i class="far fa-star"></i>';
                }

                return '
                    <p class="rating">' . $stars . '<span>(' . $averageRating . ' Rating)</span></p>
                    <a class="title" href="#">' . htmlspecialchars($row->title) . '</a>';
            })
            ->editColumn('sale', fn ($row) => '<p class="sale">' . $row->enrollments()->count() . '</p>')
            ->editColumn('status', function ($row) {
                return match ($row->status) {
                    'active' => '<td class="status"><p class="active">Active</p></td>',
                    'inactive' => '<p class="delete">Inactive</p>',
                    'draft' => '<p class="status">Draft</p>',
                    default => '<p class="unknown">Unknown</p>',
                };
            })
            ->editColumn('is_approved', function ($row) {
                return match ($row->is_approved) {
                    'approved' => '<p style="background:#159F46;">Approved</p>',
                    'rejected' => '<p style="background: #dc3545;">Rejected</p>',
                    'pending' => '<p style="background: #E79520;">Pending</p>',
                    default => '',
                };
            })
            ->editColumn('action', function ($row) {
                return '
                    <a class="edit" href="' . route('instructor.courses.edit', ['id' => $row->id, 'step' => 1]) . '">
                        <i class="fa fa-edit" aria-hidden="true"></i>
                    </a>
                    <a class="del delete-item" href="' . route('instructor.courses.destroy', $row->id) . '">
                        <i class="fas fa-trash-alt" aria-hidden="true"></i>
                    </a>';
            })
            ->rawColumns(['thumbnail', 'title', 'sale', 'status', 'is_approved','action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Course $model): QueryBuilder
    {
        $query = $model->newQuery()
            ->leftJoin('users as instructor', 'instructor.id', '=', 'courses.instructor_id')
            ->select('courses.*', 'instructor.name as instructor_name')
            ->where('courses.status', '!=', 'draft');

        if (null !== $this->instructorId) {
            $query->where('instructor_id', $this->instructorId);
        }

        // Tangkap parameter order dari request, default terbaru (created_at desc)
        $order = request('order', 'created_at_desc');

        switch ($order) {
            case 'created_at_asc':
                $query->orderBy('courses.created_at', 'asc');
                break;

            case 'created_at_desc':
                $query->orderBy('courses.created_at', 'desc');
                break;

            case 'price_asc':
                $query->orderBy('courses.price', 'asc');
                break;

            case 'price_desc':
                $query->orderBy('courses.price', 'desc');
                break;

            default:
                $query->orderBy('courses.created_at', 'desc');
                break;
        }

        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('course-table')
            ->columns($this->getColumns())
            ->minifiedAjax(
                $this->instructorId
                    ? route('instructor.data-course', ['id' => $this->instructorId])
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

            Column::computed('thumbnail')
                ->title('<span class="image">COURSES</span>')
                ->orderable(true)
                ->escape(false),

            Column::computed('title')
                ->title('<span class="title"></span>')
                ->searchable(true)
                ->orderable(false)
                ->escape(false),

            Column::computed('sale')
                ->title('<span class="sale">STUDENTS</span>')
                ->orderable(false)
                ->escape(false),

            Column::computed('status')
                ->title('<span class="status">STATUS</span>')
                ->searchable(true)
                ->orderable(true)
                ->escape(false),

            Column::computed('is_approved')
                ->title('<span class="status">APPROVED</span>')
                ->searchable(true)
                ->orderable(true)
                ->escape(false),

            Column::computed('action')
                ->title('ACTION')
                ->escape(false),
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
