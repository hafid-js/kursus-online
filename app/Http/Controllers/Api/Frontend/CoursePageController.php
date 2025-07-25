<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreReviewRequest;
use App\Http\Resources\CourseResource;
use App\Http\Resources\ReviewResource;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CoursePageController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $courses = Course::with(['enrollments', 'category', 'instructor'])
            ->where('is_approved', 'approved')
            ->where('status', 'active')
            ->when($request->has('search') && $request->filled('search'), function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%')
                      ->orWhere('description', 'like', '%' . $request->search . '%');
            })
            ->when($request->has('category') && $request->filled('category'), function ($query) use ($request) {
                if (is_array($request->category)) {
                    $query->whereIn('category_id', $request->category);
                } else {
                    $query->where('category_id', $request->category);
                }
            })
            ->when($request->filled('main_category'), function ($query) use ($request) {
                $query->whereHas('category', function ($query) use ($request) {
                    $query->whereHas('parentCategory', function ($query) use ($request) {
                        $query->where('slug', $request->main_category);
                    });
                });
            })
            ->when($request->has('level') && $request->filled('level'), function ($query) use ($request) {
                $query->whereIn('course_level_id', $request->level);
            })
            ->when($request->has('language') && $request->filled('language'), function ($query) use ($request) {
                $query->whereIn('course_language_id', $request->language);
            })
            ->when(
                $request->has('from') && $request->has('to') &&
                $request->filled('from') && $request->filled('to'),
                function ($query) use ($request) {
                    $query->whereBetween('price', [$request->from, $request->to]);
                }
            )
            ->orderBy('id', $request->filled('order') ? $request->order : 'desc')
            ->paginate(12);

        return CourseResource::collection($courses)->response();
    }

    public function show(string $slug): JsonResponse
    {
        $course = Course::with('reviews.user')->where('slug', $slug)
            ->where('is_approved', 'approved')
            ->where('status', 'active')
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'course' => new CourseResource($course),
            'reviews' => ReviewResource::collection($course->reviews),
        ]);
    }

    public function storeReview(StoreReviewRequest $request): JsonResponse
    {
        $user = $request->user();

        $checkPurchase = Enrollment::where('user_id', $user->id)
            ->where('course_id', $request->course)
            ->exists();

        if (!$checkPurchase) {
            return response()->json([
                'success' => false,
                'message' => 'Please Purchase Course First!',
            ], 403);
        }

        $alreadyReviewed = Review::where('user_id', $user->id)
            ->where('course_id', $request->course)
            ->where('status', 1)
            ->exists();

        if ($alreadyReviewed) {
            return response()->json([
                'success' => false,
                'message' => 'You Already Reviewed This Course!',
            ], 409);
        }

        $review = Review::create([
            'user_id' => $user->id,
            'course_id' => $request->course,
            'rating' => $request->rating,
            'review' => $request->review,
            'status' => 1,
        ]);

        $review->load('user');

        return response()->json([
            'success' => true,
            'message' => 'Review Submitted Successfully!',
            'data' => new ReviewResource($review),
        ]);
    }
}
