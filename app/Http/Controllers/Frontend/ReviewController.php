<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\Frontend\Instructor\ReviewDataTable;
use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReviewController extends Controller
{
    //     public function index()
    // {
    //     $reviews = Review::where('user_id', auth()->id())->paginate(10);

    //     return view('frontend.instructor-dashboard.review.index', compact('reviews'));
    // }


// public function index(Request $request)
// {
//     if ($request->ajax()) {
//         $reviews = Review::with(['user', 'course'])
//             ->whereHas('course', function ($q) {
//                 $q->where('instructor_id', auth()->id());
//             })
//             ->latest();

//         return DataTables::eloquent($reviews)
//             ->addColumn('html', function ($review) {
//                 return view('frontend.instructor-dashboard.review.partials.review-list', compact('review'))->render();
//             })
//             ->rawColumns(['html']) // penting agar HTML tidak di-escape
//             ->make(true);
//     }

//     return view('frontend.instructor-dashboard.review.index');
// }
public function index(ReviewDataTable $dataTable)
{
    if (request()->ajax()) {
        return $dataTable->ajax();
    }

    return view('frontend.instructor-dashboard.review.index');
}
// public function index(Request $request)
// {
//     if ($request->ajax()) {
//         $reviews = Review::with(['user', 'course'])
//             ->whereHas('course', function ($q) {
//                 $q->where('instructor_id', auth()->id());
//             })
//             ->latest()
//             ->get();

//         $data = $reviews->map(function ($review) {
//             return [
//                 'html' => view('frontend.instructor-dashboard.review.partials.review-list', compact('review'))->render()
//             ];
//         });

//         return response()->json(['data' => $data]);
//     }

//     return view('frontend.instructor-dashboard.review.index');
// }
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
            logger('Review Error >> ' . $e);

            return redirect()
                ->back()
                ->with('error', 'Something went wrong!');
        }
    }
}
