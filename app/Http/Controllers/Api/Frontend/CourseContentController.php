<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CourseChapter;
use App\Models\CourseChapterLession;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CourseContentController extends Controller
{
    public function createChapter(string $courseId): JsonResponse
    {
        return response()->json(['course_id' => $courseId]);
    }

    public function storeChapter(Request $request, string $courseId): JsonResponse
    {
        $request->validate([
            'title' => ['required', 'max:255'],
        ]);

        $chapter = new CourseChapter();
        $chapter->title = $request->title;
        $chapter->course_id = $courseId;
        $chapter->instructor_id = Auth::id();
        $chapter->order = CourseChapter::where('course_id', $courseId)->count() + 1;
        $chapter->save();

        return response()->json(['message' => 'Chapter created successfully', 'chapter' => $chapter], 201);
    }

    public function createLesson(Request $request): JsonResponse
    {
        $request->validate([
            'course_id' => 'required|string',
            'chapter_id' => 'required|string',
        ]);

        return response()->json([
            'course_id' => $request->course_id,
            'chapter_id' => $request->chapter_id,
        ]);
    }

    public function storeLesson(Request $request): JsonResponse
    {
        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'source' => ['required', 'string'],
            'file_type' => ['required', 'in:video,audio,file,pdf,doc'],
            'duration' => ['required'],
            'is_preview' => ['nullable', 'boolean'],
            'downloadable' => ['nullable', 'boolean'],
            'description' => ['required'],
            'course_id' => ['required', 'string'],
            'chapter_id' => ['required', 'string'],
        ];

        if ($request->filled('file')) {
            $rules['file'] = ['required'];
        } else {
            $rules['url'] = ['required'];
        }

        $request->validate($rules);

        $lesson = new CourseChapterLession();
        $lesson->title = $request->title;
        $lesson->slug = Str::slug($request->title, '-');
        $lesson->storage = $request->source;
        $lesson->file_path = $request->filled('file') ? $request->file : $request->url;
        $lesson->file_type = $request->file_type;
        $lesson->duration = $request->duration;
        $lesson->is_preview = $request->boolean('is_preview');
        $lesson->downloadable = $request->boolean('downloadable');
        $lesson->description = $request->description;
        $lesson->instructor_id = Auth::id();
        $lesson->course_id = $request->course_id;
        $lesson->chapter_id = $request->chapter_id;
        $lesson->order = CourseChapterLession::where('chapter_id', $request->chapter_id)->count() + 1;
        $lesson->save();

        return response()->json(['message' => 'Lesson created successfully', 'lesson' => $lesson], 201);
    }

    public function editChapter(string $id): JsonResponse
    {
        $chapter = CourseChapter::where('id', $id)
            ->where('instructor_id', Auth::id())
            ->firstOrFail();

        return response()->json(['chapter' => $chapter]);
    }

    public function updateChapter(Request $request, string $id): JsonResponse
    {
        $request->validate([
            'title' => ['required', 'max:255'],
        ]);

        $chapter = CourseChapter::findOrFail($id);
        $chapter->title = $request->title;
        $chapter->save();

        return response()->json(['message' => 'Chapter updated successfully', 'chapter' => $chapter]);
    }

    public function destroyChapter(string $id): JsonResponse
    {
        try {
            $chapter = CourseChapter::findOrFail($id);
            $chapter->delete();

            return response()->json(['message' => 'Chapter deleted successfully']);
        } catch (\Exception $e) {
            logger($e);

            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }

    public function editLesson(Request $request): JsonResponse
    {
        $request->validate([
            'course_id' => 'required|string',
            'chapter_id' => 'required|string',
            'lesson_id' => 'required|string',
        ]);

        $lesson = CourseChapterLession::where([
            'id' => $request->lesson_id,
            'chapter_id' => $request->chapter_id,
            'course_id' => $request->course_id,
            'instructor_id' => Auth::id(),
        ])->firstOrFail();

        return response()->json(['lesson' => $lesson]);
    }

    public function updateLesson(Request $request, string $id): JsonResponse
    {
        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'source' => ['required', 'string'],
            'file_type' => ['required', 'in:video,audio,file,pdf,doc'],
            'duration' => ['required'],
            'is_preview' => ['nullable', 'boolean'],
            'downloadable' => ['nullable', 'boolean'],
            'description' => ['required'],
            'course_id' => ['required', 'string'],
            'chapter_id' => ['required', 'string'],
        ];

        if ($request->filled('file')) {
            $rules['file'] = ['required'];
        } else {
            $rules['url'] = ['required'];
        }

        $request->validate($rules);

        $lesson = CourseChapterLession::findOrFail($id);
        $lesson->title = $request->title;
        $lesson->slug = Str::slug($request->title, '-');
        $lesson->storage = $request->source;
        $lesson->file_path = $request->filled('file') ? $request->file : $request->url;
        $lesson->file_type = $request->file_type;
        $lesson->duration = $request->duration;
        $lesson->is_preview = $request->boolean('is_preview');
        $lesson->downloadable = $request->boolean('downloadable');
        $lesson->description = $request->description;
        $lesson->instructor_id = Auth::id();
        $lesson->course_id = $request->course_id;
        $lesson->chapter_id = $request->chapter_id;
        $lesson->save();

        return response()->json(['message' => 'Lesson updated successfully', 'lesson' => $lesson]);
    }

    public function destroyLesson(string $id): JsonResponse
    {
        try {
            $lesson = CourseChapterLession::findOrFail($id);
            $lesson->delete();

            return response()->json(['message' => 'Lesson deleted successfully']);
        } catch (\Exception $e) {
            logger($e);

            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }

    public function sortLesson(Request $request, string $chapterId): JsonResponse
    {
        $newOrders = $request->order_ids;
        foreach ($newOrders as $key => $lessonId) {
            $lesson = CourseChapterLession::where(['chapter_id' => $chapterId, 'id' => $lessonId])->first();
            if ($lesson) {
                $lesson->order = $key + 1;
                $lesson->save();
            }
        }

        return response()->json(['status' => 'success', 'message' => 'Lesson order updated successfully']);
    }

    public function sortChapter(string $courseId): JsonResponse
    {
        $chapters = CourseChapter::where('course_id', $courseId)->orderBy('order')->get();

        return response()->json(['chapters' => $chapters]);
    }

    public function updateSortChapter(Request $request, string $courseId): JsonResponse
    {
        $newOrders = $request->order_ids;
        foreach ($newOrders as $key => $chapterId) {
            $chapter = CourseChapter::where(['course_id' => $courseId, 'id' => $chapterId])->first();
            if ($chapter) {
                $chapter->order = $key + 1;
                $chapter->save();
            }
        }

        return response()->json(['status' => 'success', 'message' => 'Chapter order updated successfully']);
    }
}
