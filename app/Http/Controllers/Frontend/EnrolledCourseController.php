<?php

namespace App\Http\Controllers\Frontend;

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

        if (user()->role === 'student') {
            return view('frontend.student-dashboard.enrolled-course.index', compact('enrollments'));
        } elseif (user()->role === 'instructor') {
            return view('frontend.instructor-dashboard.enrolled-course.index', compact('enrollments'));
        } else {
            abort(403, 'Unauthorized role.');
        }
    }


    public function playerIndex(String $slug)
    {
        $course = Course::with('language', 'level', 'chapters.lessons')
            ->withCount(['enrollments as student_count' => function ($query) {
                $query->whereHas('user', function ($q) {
                    $q->where('role', user()->role);
                });
            }])
            ->where('slug', $slug)
            ->firstOrFail();

        if (!Enrollment::where('user_id', user()->id)->where('course_id', $course->id)->where('have_access', 1)->exists()) {
            return abort(404);
        }

        $lessonCount = CourseChapterLession::where('course_id', $course->id)->count();
        $lastWatchHistory = WatchHistory::where([
            'user_id' => user()->id,
            'course_id' => $course->id
        ])->orderBy('updated_at', 'desc')->first();

        $watchedLessonIds = WatchHistory::where([
            'user_id' => user()->id,
            'course_id' => $course->id,
            'is_completed' => 1
        ])->pluck('lesson_id')->toArray();

        $lessonIds = $course->chapters->flatMap(function ($chapter) {
            return $chapter->lessons->pluck('id');
        });

        $totalLessonCount = $lessonIds->count();

        $completedCount = WatchHistory::whereIn('lesson_id', $lessonIds)
            ->where('user_id', user()->id)
            ->where('is_completed', 1)
            ->count();

        $showCertificate = $totalLessonCount > 0 && $completedCount === $totalLessonCount;

        $reviews = Review::where('course_id', $course->id)->get();
        $viewPath = user()->role === 'instructor'
            ? 'frontend.instructor-dashboard.enrolled-course.player-index'
            : 'frontend.student-dashboard.enrolled-course.player-index';

        return view($viewPath, compact(
            'course',
            'lastWatchHistory',
            'watchedLessonIds',
            'lessonCount',
            'showCertificate',
            'reviews'
        ));
    }


    function getLessonContent(Request $request)
    {
        $lesson = CourseChapterLession::where([
            'course_id' => $request->course_id,
            'chapter_id' => $request->chapter_id,
            'id' => $request->lesson_id
        ])->first();

        return response()->json($lesson);
    }
    function updateWatchHistory(Request $request)
    {
        WatchHistory::updateOrCreate(
            [
                'user_id' => user()->id,
                'lesson_id' => $request->lesson_id
            ],
            [
                'course_id' => $request->course_id,
                'chapter_id' => $request->chapter_id,
                'updated_at' => now()
            ]
        );
    }

    function updateLessonCompletion(Request $request): Response
    {
        $watchedLesson = WatchHistory::where([
            'user_id' => user()->id,
            'lesson_id' => $request->lesson_id
        ])->first();

        WatchHistory::updateOrCreate(
            [
                'user_id' => user()->id,
                'lesson_id' => $request->lesson_id
            ],
            [
                'course_id' => $request->course_id,
                'chapter_id' => $request->chapter_id,
                'is_completed' => $watchedLesson->is_completed == 1 ? 0 : 1,
            ]
        );

        return response(['status' => 'success', 'message' => 'Great job completing this lesson!']);
    }

    function fileDownload(string $id)
    {
        $lesson = CourseChapterLession::findOrFail($id);
        return response()->download(public_path($lesson->file_path));
    }
}
