<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseChapterLession;
use App\Models\Enrollment;
use App\Models\Review;
use App\Models\WatchHistory;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class EnrolledCourseController extends Controller
{
    use ApiResponseTrait;

    public function index(): JsonResponse
    {
        $user = auth()->user();

        $enrollments = Enrollment::with('course')
            ->where('user_id', $user->id)
            ->where('have_access', 1)
            ->get();

        return $this->sendResponse($enrollments, 'Enrolled courses fetched successfully');
    }

    public function playerIndex(string $slug): JsonResponse
    {
        $user = auth()->user();

        $course = Course::with(['language', 'level', 'chapters.lessons'])
            ->withCount(['enrollments as student_count' => function ($query) use ($user) {
                $query->whereHas('user', fn ($q) => $q->where('role', $user->role));
            }])
            ->where('slug', $slug)
            ->firstOrFail();

        $hasAccess = Enrollment::where([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'have_access' => 1,
        ])->exists();

        if (!$hasAccess) {
            return $this->sendError('Access denied. Please enroll first.', 403);
        }

        $lessonIds = $course->chapters->flatMap(fn ($chapter) => $chapter->lessons->pluck('id'));
        $totalLessonCount = $lessonIds->count();

        $completedCount = WatchHistory::whereIn('lesson_id', $lessonIds)
            ->where('user_id', $user->id)
            ->where('is_completed', 1)
            ->count();

        $showCertificate = $totalLessonCount > 0 && $completedCount === $totalLessonCount;

        $lastWatchHistory = WatchHistory::where([
            'user_id' => $user->id,
            'course_id' => $course->id,
        ])->latest('updated_at')->first();

        $watchedLessonIds = WatchHistory::where([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'is_completed' => 1,
        ])->pluck('lesson_id');

        $reviews = Review::where('course_id', $course->id)->get();

        return $this->sendResponse([
            'course' => $course,
            'last_watched' => $lastWatchHistory,
            'watched_lessons' => $watchedLessonIds,
            'show_certificate' => $showCertificate,
            'reviews' => $reviews,
        ]);
    }

    public function getLessonContent(Request $request): JsonResponse
    {
        $request->validate([
            'course_id' => ['required', 'integer'],
            'chapter_id' => ['required', 'integer'],
            'lesson_id' => ['required', 'integer'],
        ]);

        $lesson = CourseChapterLession::where([
            'course_id' => $request->course_id,
            'chapter_id' => $request->chapter_id,
            'id' => $request->lesson_id,
        ])->firstOrFail();

        return $this->sendResponse($lesson, 'Lesson content fetched successfully');
    }

    public function updateWatchHistory(Request $request): JsonResponse
    {
        $request->validate([
            'course_id' => ['required', 'integer'],
            'chapter_id' => ['required', 'integer'],
            'lesson_id' => ['required', 'integer'],
        ]);

        WatchHistory::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'lesson_id' => $request->lesson_id,
            ],
            [
                'course_id' => $request->course_id,
                'chapter_id' => $request->chapter_id,
                'updated_at' => now(),
            ]
        );

        return $this->sendResponse(null, 'Watch history updated');
    }

    public function updateLessonCompletion(Request $request): JsonResponse
    {
        $request->validate([
            'course_id' => ['required', 'integer'],
            'chapter_id' => ['required', 'integer'],
            'lesson_id' => ['required', 'integer'],
        ]);

        $userId = auth()->id();

        $watchHistory = WatchHistory::firstOrNew([
            'user_id' => $userId,
            'lesson_id' => $request->lesson_id,
        ]);

        $watchHistory->course_id = $request->course_id;
        $watchHistory->chapter_id = $request->chapter_id;
        $watchHistory->is_completed = !$watchHistory->is_completed;
        $watchHistory->save();

        return $this->sendResponse(null, 'Lesson completion updated');
    }

    public function fileDownload(string $id)
    {
        $lesson = CourseChapterLession::findOrFail($id);

        $path = public_path($lesson->file_path);
        if (!file_exists($path)) {
            return $this->sendError('File not found.', 404);
        }

        return Response::download($path);
    }
}
