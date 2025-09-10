<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseLanguage;
use App\Models\CourseLevel;
use App\Models\Enrollment;
use App\Models\Review;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CoursePageController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request): JsonResponse
    {
        $courses = Course::with('enrollments')
            ->where('is_approved', 'approved')
            ->where('status', 'active')
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('title', 'like', "%{$request->search}%")
                      ->orWhere('description', 'like', "%{$request->search}%");
            })
            ->when($request->filled('category'), function ($query) use ($request) {
                if (is_array($request->category)) {
                    $query->whereIn('category_id', $request->category);
                } else {
                    $query->where('category_id', $request->category);
                }
            })
            ->when($request->filled('main_category'), function ($query) use ($request) {
                $query->whereHas('category.parentCategory', function ($q) use ($request) {
                    $q->where('slug', $request->main_category);
                });
            })
            ->when($request->filled('level'), fn ($q) => $q->whereIn('course_level_id', $request->level))
            ->when($request->filled('language'), fn ($q) => $q->whereIn('course_language_id', $request->language))
            ->when($request->filled('from') && $request->filled('to'), fn ($q) => $q->whereBetween('price', [$request->from, $request->to]))
            ->when($request->filled('rating'), function ($query) use ($request) {
                $rating = min($request->rating);
                $query->withAvg('reviews', 'rating')
                    ->having('reviews_avg_rating', '=', $rating);
            })
            ->orderBy('id', $request->get('order', 'desc'))
            ->paginate(9);

        $filters = [
            'categories' => CourseCategory::where('status', 1)->whereNull('parent_id')->get(),
            'levels' => CourseLevel::all(),
            'languages' => CourseLanguage::all(),
        ];

        return $this->sendPaginatedResponse($courses, 'Courses fetched successfully', $filters);
    }

    public function show(string $slug): JsonResponse
    {
        $course = Course::with(['reviews', 'instructor'])
            ->where('slug', $slug)
            ->where('is_approved', 'approved')
            ->where('status', 'active')
            ->firstOrFail();

        $instructorId = $course->instructor_id;

        $students = User::whereIn('id', function ($query) use ($instructorId) {
            $query->select('user_id')
                ->from('enrollments')
                ->where('instructor_id', $instructorId);
        })->where('role', 'student')->get();

        $reviews = Review::where('course_id', $course->id)->get();

        $avgInstructorRating = Review::whereIn('course_id', function ($query) use ($instructorId) {
            $query->select('id')
                ->from('courses')
                ->where('instructor_id', $instructorId);
        })->avg('rating');

        return $this->sendResponse([
            'course' => $course,
            'reviews' => $reviews,
            'students' => $students,
            'avg_instructor_rating' => round($avgInstructorRating, 1),
        ]);
    }

    public function storeReview(Request $request): JsonResponse
    {
        $request->validate([
            'rating' => ['required', 'numeric', 'min:1', 'max:5'],
            'review' => ['required', 'string', 'max:1000'],
            'course' => ['required', 'exists:courses,id'],
        ]);

        $user = auth('sanctum')->user();

        if (!$user) {
            return $this->sendError('Unauthorized', 401);
        }

        $alreadyReviewed = Review::where('user_id', $user->id)
            ->where('course_id', $request->course)
            ->where('status', 1)
            ->exists();

        if ($alreadyReviewed) {
            return $this->sendError('You already reviewed this course.', 400);
        }

        $hasPurchased = Enrollment::where('user_id', $user->id)
            ->where('course_id', $request->course)
            ->exists();

        if (!$hasPurchased) {
            return $this->sendError('You must purchase the course before reviewing.', 403);
        }

        Review::create([
            'user_id' => $user->id,
            'course_id' => $request->course,
            'rating' => $request->rating,
            'review' => $request->review,
            'status' => 1,
        ]);

        return $this->sendResponse(null, 'Review submitted successfully!');
    }
}
