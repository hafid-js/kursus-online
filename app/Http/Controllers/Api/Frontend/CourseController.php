<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CourseBasicInfoCreateRequest;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseChapter;
use App\Models\CourseChapterLession;
use App\Models\CourseLanguage;
use App\Models\CourseLevel;
use App\Models\OrderItem;
use App\Models\WatchHistory;
use App\Traits\FileUpload;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    use FileUpload;

    public function index(): JsonResponse
    {
        $courses = Course::where('instructor_id', Auth::id())
            ->orderBy('id', 'desc')
            ->get();

        return response()->json(['status' => 'success', 'data' => $courses]);
    }

    public function storeBasicInfo(CourseBasicInfoCreateRequest $request): JsonResponse
    {
        $thumbnail = $this->uploadFile($request->file('thumbnail'));

        $course = Course::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'seo_description' => $request->seo_description,
            'thumbnail' => $thumbnail,
            'demo_video_storage' => $request->demo_video_storage,
            'demo_video_source' => $request->demo_video_source,
            'price' => $request->price,
            'discount' => $request->discount,
            'description' => $request->description,
            'instructor_id' => Auth::id(),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Course created successfully',
            'data' => $course,
            'next' => route('instructor.courses.edit', ['id' => $course->id, 'step' => $request->next_step]),
        ]);
    }

    public function edit(Request $request): JsonResponse
    {
        $step = (int) $request->step;
        $id = (int) $request->id;
        $course = Course::findOrFail($id);

        switch ($step) {
            case 2:
                $categories = CourseCategory::where('status', 1)->get();
                $levels = CourseLevel::all();
                $languages = CourseLanguage::all();

                return response()->json(compact('course', 'categories', 'levels', 'languages'));
            case 3:
                $chapters = CourseChapter::where('course_id', $id)
                    ->where('instructor_id', Auth::id())
                    ->orderBy('order')
                    ->get();

                return response()->json(compact('course', 'chapters'));
            case 4:
                return response()->json(compact('course'));
            default:
                return response()->json(['course' => $course]);
        }
    }

    public function update(Request $request): JsonResponse
    {
        $step = (int) $request->current_step;
        $course = Course::findOrFail($request->id);

        try {
            if (1 === $step) {
                $request->validate([
                    'title' => 'required|string|max:255',
                    'seo_description' => 'nullable|string|max:255',
                    'demo_video_storage' => 'nullable|string|in:youtube,vimeo,external_link,upload',
                    'price' => 'required|numeric',
                    'discount' => 'nullable|numeric',
                    'description' => 'required',
                    'thumbnail' => 'nullable|image|max:3000',
                    'file' => 'required_without:url',
                    'url' => 'required_without:file',
                ]);

                if ($request->hasFile('thumbnail')) {
                    $thumbnail = $this->uploadFile($request->file('thumbnail'));
                    $this->deleteFile($course->thumbnail);
                    $course->thumbnail = $thumbnail;
                }

                $course->fill([
                    'title' => $request->title,
                    'slug' => Str::slug($request->title),
                    'seo_description' => $request->seo_description,
                    'demo_video_storage' => $request->demo_video_storage,
                    'demo_video_source' => $request->file ?? $request->url,
                    'price' => $request->price,
                    'discount' => $request->discount,
                    'description' => $request->description,
                ])->save();

                return response()->json(['status' => 'success', 'message' => 'Basic info updated', 'next' => route('instructor.courses.edit', ['id' => $course->id, 'step' => $request->next_step])]);
            } elseif (2 === $step) {
                $request->validate([
                    'capacity' => 'nullable|numeric',
                    'duration' => 'required|numeric',
                    'qna' => 'nullable|boolean',
                    'certificate' => 'nullable|boolean',
                    'category' => 'required|integer',
                    'level' => 'required|integer',
                    'language' => 'required|integer',
                ]);

                $course->update([
                    'capacity' => $request->capacity,
                    'duration' => $request->duration,
                    'qna' => $request->qna ? 1 : 0,
                    'certificate' => $request->certificate ? 1 : 0,
                    'category_id' => $request->category,
                    'course_level_id' => $request->level,
                    'course_language_id' => $request->language,
                ]);

                return response()->json(['status' => 'success', 'message' => 'Additional info updated', 'next' => route('instructor.courses.edit', ['id' => $course->id, 'step' => $request->next_step])]);
            } elseif (3 === $step) {
                $request->validate([
                    'id' => 'required|integer|exists:course_chapter_lessions,id',
                    'title' => 'required|string|max:255',
                    'source' => 'required|string|in:upload,youtube,vimeo,external',
                    'file' => 'nullable|string', 'url' => 'nullable|string',
                    'duration' => 'required|numeric',
                    'description' => 'required|string',
                    'next_step' => 'required|integer',
                ]);

                $lesson = CourseChapterLession::where('id', $request->id)
                    ->where('instructor_id', Auth::id())
                    ->firstOrFail();

                $lesson->update([
                    'storage' => $request->source,
                    'file_path' => 'upload' === $request->source ? $request->file : $request->url,
                    'title' => $request->title,
                    'file_type' => $request->file_type,
                    'duration' => $request->duration,
                    'is_preview' => $request->filled('is_preview') ? 1 : 0,
                    'downloadable' => $request->filled('downloadable') ? 1 : 0,
                    'description' => $request->description,
                ]);

                return response()->json(['status' => 'success', 'message' => 'Lesson updated', 'next' => route('instructor.courses.edit', ['id' => $course->id, 'step' => $request->next_step])]);
            } elseif (4 === $step) {
                $request->validate([
                    'message' => 'nullable|string|max:1000',
                    'status' => 'required|in:active,inactive,draft',
                ]);

                $course->update([
                    'message_for_reviewer' => $request->message,
                    'status' => $request->status,
                ]);

                return response()->json(['status' => 'success', 'message' => 'Course step 4 updated', 'redirect' => route('instructor.courses.index')]);
            }
        } catch (\Exception $e) {
            logger()->error("Course update step {$step} failed: " . $e->getMessage());

            return response()->json(['status' => 'error', 'message' => 'Update failed'], 500);
        }

        return response()->json(['status' => 'error', 'message' => 'Invalid step'], 400);
    }

    public function students(): JsonResponse
    {
        $instructorId = Auth::id();

        $students = OrderItem::whereHas('course', fn ($q) => $q->where('instructor_id', $instructorId))
            ->with(['course', 'order.customer'])
            ->get()
            ->map(function ($item) {
                $courseId = $item->course_id;
                $userId = $item->order->customer->id;
                $lessonCount = CourseChapterLession::where('course_id', $courseId)->count();
                $watchedCount = WatchHistory::where([
                    'user_id' => $userId, 'course_id' => $courseId, 'is_completed' => 1,
                ])->count();
                $item->lessonCount = $lessonCount;
                $item->watchedCount = $watchedCount;
                $item->progressPercent = $lessonCount > 0 ? round($watchedCount / $lessonCount * 100) : 0;

                return $item;
            });

        return response()->json(['status' => 'success', 'students' => $students]);
    }

    public function destroy(Course $course): JsonResponse
    {
        if (Auth::id() !== $course->instructor_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        try {
            $course->delete();

            return response()->json(['status' => 'success', 'message' => 'Course deleted']);
        } catch (\Exception $e) {
            logger()->error('Destroy course failed: ' . $e->getMessage());

            return response()->json(['status' => 'error', 'message' => 'Delete failed'], 500);
        }
    }
}
