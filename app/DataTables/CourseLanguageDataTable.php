<?php

namespace App\DataTables;

use App\Models\CourseLanguage;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CourseLanguageDataTable extends DataTable
{
    /**
     * Build the DataTable class.
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
            ->addColumn('action', function ($row) {
                return '
                    <a href="javascript:;" class="edit edit_course_language" data-language-id="' . $row->id . '">
                        <i class="ti ti-edit"></i>
                    </a>
                    <a href="' . route('admin.course-languages.destroy', $row->id) . '" class="text-red delete-item">
                        <i class="ti ti-trash"></i>
                    </a>
                ';
            })
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(CourseLanguage $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the HTML builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('course_languages')
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
                'ordering' => true,
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
     * Get the DataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex')
                ->title('No.')
                ->searchable(false)
                ->orderable(false)
                ->width(80),

            Column::make('name')
                ->title('<span class="table-sort d-flex justify-content-start">Name</span>')
                ->orderable(true)
                ->escape(false)
                ->width(600),

            Column::make('slug')
                ->title('<span class="table-sort d-flex justify-content-start">Slug</span>')
                ->orderable(true)
                ->escape(false)
                ->width(100),

            Column::computed('action')
                ->title('Action')
                ->searchable(false)
                ->orderable(false)
                ->width(100),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'CourseLanguages_' . date('YmdHis');
    }
}
