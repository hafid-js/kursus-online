<?php

namespace App\DataTables\Frontend\Instructor;

use App\Models\Review;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class ReviewDataTable extends DataTable
{

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('review', function ($review) {
                $image = $review->user?->image
                    ? asset($review->user->image)
                    : asset('frontend/assets/images/image-profile.png');

                return view('frontend.instructor-dashboard.review.partials.review-list', [
                    'review'        => $review,
                    'image'         => $image,
                ])->render();
            })
            ->rawColumns(['review']);
    }

    public function query(Review $model): QueryBuilder
    {
        $query = $model->newQuery()
            ->with('course.instructor')
            ->whereHas('course', fn($q) => $q->where('instructor_id', auth()->id()));

        if ($rating = request('rating')) {
            $query->where('rating', $rating);
        }
        if (null !== $this->courseId) {
            $query->where('course_id', $this->courseId);
        }

        if ($sort = request('sort')) {
            switch ($sort) {
                case 'rating_desc':
                    $query->orderBy('rating', 'desc');
                    break;
                case 'rating_asc':
                    $query->orderBy('rating', 'asc');
                    break;
                case 'date_desc':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'date_asc':
                    $query->orderBy('created_at', 'asc');
                    break;
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        return $query;
    }
}
