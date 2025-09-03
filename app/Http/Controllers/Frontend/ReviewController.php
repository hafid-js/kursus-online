<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\Frontend\Instructor\ReviewDataTable;
use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\ReviewReply;
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

    public function reply(Request $request)
    {
        $request->validate([
            'review_id' => 'required|exists:reviews,id',
            'reply'     => 'required|string|max:2000',
        ]);

        $review = Review::with('course')->findOrFail($request->review_id);

        // Cek instructor yang punya course
        if ($review->course->instructor_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        ReviewReply::create([
            'review_id' => $review->id,
            'user_id'   => auth()->id(),
            'reply'     => $request->reply,
        ]);

        return response()->json([
            'message' => 'Reply has been successfully.'
        ]);
    }

    public function updateReply(Request $request)
{
    $request->validate([
        'reply_id' => 'required|exists:review_replies,id',
        'reply' => 'required|string',
    ]);

    $reply = ReviewReply::findOrFail($request->reply_id);

    // Optional: Check if user has permission
    if ($reply->user_id != auth()->id()) {
        return response()->json(['message' => 'Unauthorized.'], 403);
    }

    $reply->update([
        'reply' => $request->reply,
    ]);

    return response()->json(['message' => 'Reply updated successfully!']);
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
