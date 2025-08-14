<?php

namespace App\DataTables;

use App\Models\CourseCategory;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CourseCategoriesDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $dataTable = new EloquentDataTable($query);

        // Custom search handling
        if ($keyword = request()->input('search.value')) {
            $dataTable->filter(function ($query) use ($keyword) {
                $query->where('name', 'like', "%{$keyword}%");
            }, true);
        }

        return $dataTable
            ->addIndexColumn()
            ->addColumn('icon', function ($row) {
                return $row->image
                    ? '<img src="' . asset($row->image) . '" width="32">'
                    : '<span class="text-muted">No image</span>';
            })
            ->addColumn('show_at_trending', function ($row) {
                return $row->show_at_trending ? '<span class="badge bg-lime text-lime-fg">Yes</span>' : '<span class="badge bg-red text-red-fg">No</span>';
            })
            ->addColumn('status', function ($row) {
                return $row->status ? '<span class="badge bg-lime text-lime-fg">Yes</span>' : '<span class="badge bg-red text-red-fg">No</span>';
            })
            ->addColumn('action', function ($row) {
                return '
                <a href="' . route('admin.course-sub-categories.index', $row->id) . '" class="btn-sm text-warning">
                    <i class="ti ti-list"></i>
                </a>
                <a class="edit edit_course_category" data-category-id="' . $row->id . '" href="javascript:;"><i class="ti ti-edit" aria-hidden="true"></i></a>
                <a href="' . route('admin.course-categories.destroy', $row->id) . '" class="text-red delete-item">
                    <i class="ti ti-trash"></i>
                </a>';
            })
            ->rawColumns(['icon', 'show_at_trending', 'status', 'action'])
            ->setRowId('id');
    }



    /**
     * Get the query source of dataTable.
     */
    public function query(CourseCategory $model): QueryBuilder
    {
        return $model->newQuery()->whereNull('parent_id');
    }


    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('course_categories')
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
                'dom' => 'rt<"row mt-2"<"col-sm-6"><"col-sm-6">>',
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
            Column::make('name')->title('Name')->width('600'),
            Column::computed('icon')->title('Icon')->orderable(false)->searchable(false)->width('100'),
            Column::make('show_at_trending')->title('Trending')->width('100'),
            Column::make('status')->title('Status')->width('80'),
            Column::make('action')->title('Action')->width('100'),
        ];
    }


    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'CourseCategories_' . date('YmdHis');
    }
}
