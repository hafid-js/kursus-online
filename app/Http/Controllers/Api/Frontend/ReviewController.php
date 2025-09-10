<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\ReviewReply;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $user = auth()->user();

        if ($user->role !== 'instructor') {
            return $this->sendError('Unauthorized', 403);
        }

        $reviews = Review::whereHas('course', function ($query) use ($user) {
            $query->where('instructor_id', $user->id);
        })->with(['user', 'course', 'reply'])->latest()->paginate(10);

        return $this->sendPaginatedResponse($reviews, 'Reviews retrieved successfully.');
    }

    public function reply(Request $request)
    {
        $request->validate([
            'review_id' => 'required|exists:reviews,id',
            'reply'     => 'required|string|max:2000',
        ]);

        $review = Review::with('course')->findOrFail($request->review_id);

        if ($review->course->instructor_id !== auth()->id()) {
            return $this->sendError('Unauthorized', 403);
        }

        $reply = ReviewReply::create([
            'review_id' => $review->id,
            'user_id'   => auth()->id(),
            'reply'     => $request->reply,
        ]);

        return $this->sendResponse($reply, 'Reply has been added successfully.');
    }

    public function updateReply(Request $request)
    {
        $request->validate([
            'reply_id' => 'required|exists:review_replies,id',
            'reply'    => 'required|string|max:2000',
        ]);

        $reply = ReviewReply::findOrFail($request->reply_id);

        if ($reply->user_id !== auth()->id()) {
            return $this->sendError('Unauthorized', 403);
        }

        $reply->update([
            'reply' => $request->reply,
        ]);

        return $this->sendResponse($reply, 'Reply updated successfully.');
    }

    public function destroy(string $id)
    {
        try {
            $review = Review::where('id', $id)
                ->where('user_id', auth()->id())
                ->firstOrFail();

            $review->delete();

            return $this->sendResponse(null, 'Review deleted successfully.');
        } catch (\Exception $e) {
            logger()->error('Review Delete Error >> ' . $e->getMessage());

            return $this->sendError('Something went wrong.', 500);
        }
    }
}
