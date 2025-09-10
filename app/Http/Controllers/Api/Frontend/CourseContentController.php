<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CourseChapter;
use App\Models\CourseChapterLession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Traits\ApiResponseTrait;

class CourseContentController extends Controller
{
    use ApiResponseTrait;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function createChapter(string $courseId)
    {
        if (! $this->isInstructorForCourse($courseId)) {
            return $this->sendError('Unauthorized', 403);
        }
        return $this->sendResponse(['course_id' => $courseId], 'Create chapter data ready');
    }

    public function storeChapter(Request $request, string $courseId)
    {
        if (! $this->isInstructorForCourse($courseId)) {
            return $this->sendError('Unauthorized', 403);
        }

        $request->validate(['title' => 'required|max:255']);

        $chapter = new CourseChapter();
        $chapter->title = $request->title;
        $chapter->course_id = $courseId;
        $chapter->instructor_id = Auth::id();
        $chapter->order = CourseChapter::where('course_id', $courseId)->count() + 1;
        $chapter->save();

        return $this->sendResponse($chapter, 'Chapter created successfully');
    }

    public function createLesson(Request $request)
    {
        $courseId = $request->course_id;
        $chapterId = $request->chapter_id;

        if (! $this->isInstructorForCourse($courseId)) {
            return $this->sendError('Unauthorized', 403);
        }

        return $this->sendResponse([
            'course_id' => $courseId,
            'chapter_id' => $chapterId,
        ], 'Create lesson data ready');
    }

    public function storeLesson(Request $request)
    {
        $courseId = $request->course_id;
        $chapterId = $request->chapter_id;

        if (! $this->isInstructorForCourse($courseId)) {
            return $this->sendError('Unauthorized', 403);
        }

        $rules = [
            'title' => 'required|string|max:255',
            'source' => 'required|string',
            'file_type' => 'required|in:video,audio,file,pdf,doc',
            'duration' => 'required',
            'is_preview' => 'nullable|boolean',
            'downloadable' => 'nullable|boolean',
            'description' => 'required|string',
        ];

        if ($request->filled('file')) {
            $rules['file'] = 'required';
        } else {
            $rules['url'] = 'required';
        }

        $request->validate($rules);

        $lesson = new CourseChapterLession();
        $lesson->title = $request->title;
        $lesson->slug = Str::slug($request->title);
        $lesson->storage = $request->source;
        $lesson->file_path = $request->filled('file') ? $request->file : $request->url;
        $lesson->file_type = $request->file_type;
        $lesson->duration = $request->duration;
        $lesson->is_preview = $request->filled('is_preview') ? 1 : 0;
        $lesson->downloadable = $request->filled('downloadable') ? 1 : 0;
        $lesson->description = $request->description;
        $lesson->instructor_id = Auth::id();
        $lesson->course_id = $courseId;
        $lesson->chapter_id = $chapterId;
        $lesson->order = CourseChapterLession::where('chapter_id', $chapterId)->count() + 1;
        $lesson->save();

        return $this->sendResponse($lesson, 'Lesson created successfully');
    }

    public function editChapter(string $id)
    {
        $chapter = CourseChapter::where('id', $id)
            ->where('instructor_id', Auth::id())
            ->first();

        if (! $chapter) {
            return $this->sendError('Chapter not found or unauthorized', 404);
        }

        return $this->sendResponse($chapter, 'Chapter data retrieved');
    }

    public function updateChapter(Request $request, string $id)
    {
        $chapter = CourseChapter::find($id);

        if (! $chapter || $chapter->instructor_id !== Auth::id()) {
            return $this->sendError('Chapter not found or unauthorized', 404);
        }

        $request->validate(['title' => 'required|max:255']);

        $chapter->title = $request->title;
        $chapter->save();

        return $this->sendResponse($chapter, 'Chapter updated successfully');
    }

    public function destroyChapter(string $id)
    {
        $chapter = CourseChapter::find($id);

        if (! $chapter || $chapter->instructor_id !== Auth::id()) {
            return $this->sendError('Chapter not found or unauthorized', 404);
        }

        $chapter->delete();

        return $this->sendResponse(null, 'Chapter deleted successfully');
    }

    public function editLesson(Request $request)
    {
        $lesson = CourseChapterLession::where([
            'id' => $request->lesson_id,
            'chapter_id' => $request->chapter_id,
            'course_id' => $request->course_id,
            'instructor_id' => Auth::id(),
        ])->first();

        if (! $lesson) {
            return $this->sendError('Lesson not found or unauthorized', 404);
        }

        return $this->sendResponse($lesson, 'Lesson data retrieved');
    }

    public function updateLesson(Request $request, string $id)
    {
        $lesson = CourseChapterLession::find($id);

        if (! $lesson || $lesson->instructor_id !== Auth::id()) {
            return $this->sendError('Lesson not found or unauthorized', 404);
        }

        $rules = [
            'title' => 'required|string|max:255',
            'source' => 'required|string',
            'file_type' => 'required|in:video,audio,file,pdf,doc',
            'duration' => 'required',
            'is_preview' => 'nullable|boolean',
            'downloadable' => 'nullable|boolean',
            'description' => 'required|string',
        ];

        if ($request->filled('file')) {
            $rules['file'] = 'required';
        } else {
            $rules['url'] = 'required';
        }

        $request->validate($rules);

        $lesson->title = $request->title;
        $lesson->slug = Str::slug($request->title);
        $lesson->storage = $request->source;
        $lesson->file_path = $request->filled('file') ? $request->file : $request->url;
        $lesson->file_type = $request->file_type;
        $lesson->duration = $request->duration;
        $lesson->is_preview = $request->filled('is_preview') ? 1 : 0;
        $lesson->downloadable = $request->filled('downloadable') ? 1 : 0;
        $lesson->description = $request->description;
        $lesson->save();

        return $this->sendResponse($lesson, 'Lesson updated successfully');
    }

    public function destroyLesson(string $id)
    {
        $lesson = CourseChapterLession::find($id);

        if (! $lesson || $lesson->instructor_id !== Auth::id()) {
            return $this->sendError('Lesson not found or unauthorized', 404);
        }

        $lesson->delete();

        return $this->sendResponse(null, 'Lesson deleted successfully');
    }

    public function sortLesson(Request $request, string $chapterId)
    {
        if (! $this->isInstructorForChapter($chapterId)) {
            return $this->sendError('Unauthorized', 403);
        }

        $newOrders = $request->order_ids;

        foreach ($newOrders as $index => $lessonId) {
            $lesson = CourseChapterLession::where('chapter_id', $chapterId)->where('id', $lessonId)->first();
            if ($lesson) {
                $lesson->order = $index + 1;
                $lesson->save();
            }
        }

        return $this->sendResponse(null, 'Lesson order updated successfully');
    }

    public function getChapters(string $courseId)
    {
        if (! $this->isInstructorForCourse($courseId)) {
            return $this->sendError('Unauthorized', 403);
        }

        $chapters = CourseChapter::where('course_id', $courseId)->orderBy('order')->get();

        return $this->sendResponse($chapters, 'Chapters retrieved');
    }

    public function sortChapter(Request $request, string $courseId)
    {
        if (! $this->isInstructorForCourse($courseId)) {
            return $this->sendError('Unauthorized', 403);
        }

        $newOrders = $request->order_ids;

        foreach ($newOrders as $index => $chapterId) {
            $chapter = CourseChapter::where('course_id', $courseId)->where('id', $chapterId)->first();
            if ($chapter) {
                $chapter->order = $index + 1;
                $chapter->save();
            }
        }

        return $this->sendResponse(null, 'Chapter order updated successfully');
    }

    private function isInstructorForCourse(string $courseId): bool
    {
        // Assuming Course model has instructor_id
        $course = \App\Models\Course::find($courseId);
        return $course && $course->instructor_id == Auth::id();
    }

    private function isInstructorForChapter(string $chapterId): bool
    {
        $chapter = CourseChapter::find($chapterId);
        return $chapter && $chapter->instructor_id == Auth::id();
    }
}
