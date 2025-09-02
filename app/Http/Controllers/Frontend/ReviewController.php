<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\Frontend\Instructor\ReviewDataTable;
use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(ReviewDataTable $dataTable)
    {
        if (request()->ajax()) {
            return $dataTable->ajax();
        }

        return view('frontend.instructor-dashboard.review.index');
    }

    public function reviewDestroy(string $id)
    {
        try {
            $review = Review::where('id', $id)
                ->where('user_id', auth()->id())
                ->firstOrFail();

            $review->delete();

            return redirect()
                ->back()
                ->with('success', 'Review deleted successfully!');
        } catch (\Exception $e) {
            logger()->error('Review Error >> ' . $e->getMessage());

            return redirect()
                ->back()
                ->with('error', 'Something went wrong!');
        }
    }
}
