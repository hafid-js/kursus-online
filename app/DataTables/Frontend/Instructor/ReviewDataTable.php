<?php

namespace App\DataTables\Frontend\Instructor;

use App\Models\Review;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ReviewDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
{
    return (new EloquentDataTable($query))
        ->addColumn('review', function ($review) {
            $image = $review->course?->instructor?->image
                ? asset($review->course->instructor->image)
                : asset('frontend/assets/images/image-profile.png');

            return view('frontend.instructor-dashboard.review.partials.review-list', [
                'review' => $review,
                'image'  => $image,
            ])->render();
        })
        ->rawColumns(['review']);
}

public function query(Review $model): QueryBuilder
{
    return $model->newQuery()
        ->with('course.instructor') // perbaikan di sini
        ->whereHas('course', fn($q) => $q->where('instructor_id', auth()->id()));
}

}
