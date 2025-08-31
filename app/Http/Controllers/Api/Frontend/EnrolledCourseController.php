<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseChapterLession;
use App\Models\Enrollment;
use App\Models\Review;
use App\Models\WatchHistory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EnrolledCourseController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with('course')
            ->where('user_id', user()->id)
            ->whereHas('course')
            ->get();

        return response()->json(['enrollments' => $enrollments]);
    }

    public function playerIndex(string $slug)
    {
        $course = Course::with('language', 'level', 'chapters.lessons')
            ->withCount(['enrollments as student_count' => function ($query) {
                $query->whereHas('user', fn ($q) => $q->where('role', 'student'));
            }])
            ->where('slug', $slug)
            ->firstOrFail();

        if (!Enrollment::where('user_id', user()->id)->where('course_id', $course->id)->where('have_access', 1)->exists()) {
            return response()->json(['message' => 'Access denied'], 403);
        }

        $lessonCount = CourseChapterLession::where('course_id', $course->id)->count();
        $lastWatchHistory = WatchHistory::where([
            'user_id' => user()->id,
            'course_id' => $course->id,
        ])->orderByDesc('updated_at')->first();

        $watchedLessonIds = WatchHistory::where([
            'user_id' => user()->id,
            'course_id' => $course->id,
            'is_completed' => 1,
        ])->pluck('lesson_id')->toArray();

        $userId = user()->id;
        $lessonIds = $course->chapters->flatMap(fn ($chapter) => $chapter->lessons->pluck('id'));
        $totalLessonCount = $lessonIds->count();

        $completedCount = WatchHistory::whereIn('lesson_id', $lessonIds)
            ->where('user_id', $userId)
            ->where('is_completed', 1)
            ->count();

        $showCertificate = $totalLessonCount > 0 && $completedCount === $totalLessonCount;

        $reviews = Review::where('course_id', $course->id)->get();

        return response()->json([
            'course' => $course,
            'lastWatchHistory' => $lastWatchHistory,
            'watchedLessonIds' => $watchedLessonIds,
            'lessonCount' => $lessonCount,
            'showCertificate' => $showCertificate,
            'reviews' => $reviews,
        ]);
    }

    public function getLessonContent(Request $request)
    {
        $lesson = CourseChapterLession::where([
            'course_id' => $request->course_id,
            'chapter_id' => $request->chapter_id,
            'id' => $request->lesson_id,
        ])->first();

        if (!$lesson) {
            return response()->json(['message' => 'Lesson not found'], 404);
        }

        return response()->json($lesson);
    }

    public function updateWatchHistory(Request $request)
    {
        WatchHistory::updateOrCreate(
            [
                'user_id' => user()->id,
                'lesson_id' => $request->lesson_id,
            ],
            [
                'course_id' => $request->course_id,
                'chapter_id' => $request->chapter_id,
                'updated_at' => now(),
            ]
        );

        return response()->json(['status' => 'success']);
    }

    public function updateLessonCompletion(Request $request): Response
    {
        $watchedLesson = WatchHistory::where([
            'user_id' => user()->id,
            'lesson_id' => $request->lesson_id,
        ])->first();

        $newStatus = ($watchedLesson && 1 == $watchedLesson->is_completed) ? 0 : 1;

        WatchHistory::updateOrCreate(
            [
                'user_id' => user()->id,
                'lesson_id' => $request->lesson_id,
            ],
            [
                'course_id' => $request->course_id,
                'chapter_id' => $request->chapter_id,
                'is_completed' => $newStatus,
            ]
        );

        return response(['status' => 'success', 'message' => 'Great job completing this lesson!']);
    }

    public function fileDownload(string $id)
    {
        $lesson = CourseChapterLession::findOrFail($id);

        return response()->download(public_path($lesson->file_path));
    }
}
