<?php

namespace App\Http\Controllers\Api\Frontend;

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
use App\Traits\ApiResponseTrait;
use App\Traits\FileUpload;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    use FileUpload, ApiResponseTrait;

    public function index(Request $request): JsonResponse
    {
        $courses = Course::where('instructor_id', Auth::id())
            ->orderByDesc('id')
            ->paginate(10);

        $pagination = [
            'total' => $courses->total(),
            'per_page' => $courses->perPage(),
            'current_page' => $courses->currentPage(),
            'last_page' => $courses->lastPage(),
            'from' => $courses->firstItem(),
            'to' => $courses->lastItem(),
        ];

        return $this->sendPaginatedResponse(
            $courses,
            'Courses retrieved successfully',
            $pagination
        );
    }

    public function getAllCourse(string $id)
    {
        $courses = Course::with('instructor')
            ->where('status', '!=', 'draft')
            ->when($id, function ($q) use ($id) {
                $q->where('instructor_id', $id);
            })
            ->select('courses.*')
            ->paginate(10);

        $pagination = [
            'total' => $courses->total(),
            'per_page' => $courses->perPage(),
            'current_page' => $courses->currentPage(),
            'last_page' => $courses->lastPage(),
            'from' => $courses->firstItem(),
            'to' => $courses->lastItem(),
        ];

        return $this->sendPaginatedResponse(
            $courses,
            'Courses retrieved successfully',
            $pagination
        );
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

        return $this->sendResponse(
            [
                'course' => $course,
                'next' => route('instructor.courses.edit', [
                    'id' => $course->id,
                    'step' => $request->next_step,
                ]),
            ],
            'Course created successfully'
        );
    }

    public function edit(Request $request): JsonResponse
    {
        $step = (int) $request->step;
        $course = Course::where('id', $request->id)
            ->where('instructor_id', Auth::id())
            ->firstOrFail();

        $data = ['course' => $course];

        if ($step === 2) {
            $data = array_merge($data, [
                'categories' => CourseCategory::where('status', 1)->get(),
                'levels' => CourseLevel::all(),
                'languages' => CourseLanguage::all(),
            ]);
        } elseif ($step === 3) {
            $data['chapters'] = CourseChapter::where('course_id', $course->id)
                ->where('instructor_id', Auth::id())
                ->orderBy('order')
                ->get();
        }

        return $this->sendResponse($data);
    }

    public function update(Request $request): JsonResponse
    {
        $step = (int) $request->current_step;
        $course = Course::where('id', $request->id)
            ->where('instructor_id', Auth::id())
            ->firstOrFail();

        try {
            $nextRoute = null;

            if ($step === 1) {
                $validated = $request->validate([
                    'title' => 'required|string|max:255',
                    'seo_description' => 'nullable|string|max:255',
                    'demo_video_storage' => 'required|string|in:youtube,vimeo,external_link,upload',
                    'price' => 'required|numeric',
                    'discount' => 'nullable|numeric',
                    'description' => 'required|string',
                    'thumbnail' => 'nullable|image|max:3000',
                    'file' => 'required_if:demo_video_storage,upload|nullable|file',
                    'url' => 'required_if:demo_video_storage,youtube,vimeo,external_link|nullable|url',
                ]);

                if ($request->hasFile('thumbnail')) {
                    $thumbnail = $this->uploadFile($request->file('thumbnail'));
                    $this->deleteFile($course->thumbnail);
                    $course->thumbnail = $thumbnail;
                }

                $course->fill([
                    'title' => $validated['title'],
                    'slug' => Str::slug($validated['title']),
                    'seo_description' => $validated['seo_description'] ?? null,
                    'demo_video_storage' => $validated['demo_video_storage'],
                    'demo_video_source' => $request->file ?? $request->url,
                    'price' => $validated['price'],
                    'discount' => $validated['discount'] ?? null,
                    'description' => $validated['description'],
                ])->save();

                $nextRoute = route('instructor.courses.edit', [
                    'id' => $course->id,
                    'step' => $request->next_step,
                ]);
                return $this->sendResponse(['next' => $nextRoute], 'Basic info updated');
            }

            if ($step === 2) {
                $validated = $request->validate([
                    'capacity' => 'nullable|numeric',
                    'duration' => 'required|numeric',
                    'qna' => 'nullable|boolean',
                    'certificate' => 'nullable|boolean',
                    'category' => 'required|integer|exists:course_categories,id',
                    'level' => 'required|integer|exists:course_levels,id',
                    'language' => 'required|integer|exists:course_languages,id',
                ]);

                $course->update([
                    'capacity' => $validated['capacity'] ?? null,
                    'duration' => $validated['duration'],
                    'qna' => $validated['qna'] ?? false,
                    'certificate' => $validated['certificate'] ?? false,
                    'category_id' => $validated['category'],
                    'course_level_id' => $validated['level'],
                    'course_language_id' => $validated['language'],
                ]);

                $nextRoute = route('instructor.courses.edit', [
                    'id' => $course->id,
                    'step' => $request->next_step,
                ]);
                return $this->sendResponse(['next' => $nextRoute], 'Additional info updated');
            }

            if ($step === 3) {
                $validated = $request->validate([
                    'id' => 'required|integer|exists:course_chapter_lessions,id',
                    'title' => 'required|string|max:255',
                    'source' => 'required|string|in:upload,youtube,vimeo,external',
                    'file' => 'nullable|string',
                    'url' => 'nullable|string',
                    'duration' => 'required|numeric',
                    'description' => 'required|string',
                    'next_step' => 'required|integer',
                    'file_type' => 'nullable|string',
                    'is_preview' => 'nullable|boolean',
                    'downloadable' => 'nullable|boolean',
                ]);

                $lesson = CourseChapterLession::where('id', $validated['id'])
                    ->where('instructor_id', Auth::id())
                    ->firstOrFail();

                $lesson->update([
                    'title' => $validated['title'],
                    'storage' => $validated['source'],
                    'file_path' => $validated['source'] === 'upload' ? $validated['file'] : $validated['url'],
                    'file_type' => $validated['file_type'] ?? null,
                    'duration' => $validated['duration'],
                    'is_preview' => $validated['is_preview'] ?? false,
                    'downloadable' => $validated['downloadable'] ?? false,
                    'description' => $validated['description'],
                ]);

                $nextRoute = route('instructor.courses.edit', [
                    'id' => $course->id,
                    'step' => $validated['next_step'],
                ]);
                return $this->sendResponse(['next' => $nextRoute], 'Lesson updated');
            }

            if ($step === 4) {
                $validated = $request->validate([
                    'message' => 'nullable|string|max:1000',
                    'status' => 'required|in:active,inactive,draft',
                ]);

                $course->update([
                    'message_for_reviewer' => $validated['message'] ?? null,
                    'status' => $validated['status'],
                ]);

                $nextRoute = route('instructor.courses.index');
                return $this->sendResponse(['next' => $nextRoute], 'Course step 4 updated');
            }
        } catch (\Exception $e) {
            logger()->error("Course update step {$step} failed: " . $e->getMessage());
            return $this->sendError('Update failed', 500);
        }

        return $this->sendError('Invalid step', 400);
    }

    public function students(): JsonResponse
    {
        $instructorId = Auth::id();

        $students = OrderItem::whereHas('course', fn($q) => $q->where('instructor_id', $instructorId))
            ->with(['course', 'order.customer'])
            ->get()
            ->map(fn($item) => [
                'order_item' => $item,
                'lesson_count' => CourseChapterLession::where('course_id', $item->course_id)->count(),
                'watched_count' => WatchHistory::where([
                    'user_id' => $item->order->customer->id,
                    'course_id' => $item->course_id,
                    'is_completed' => 1,
                ])->count(),
                'progress_percent' => ($lessonCount = CourseChapterLession::where('course_id', $item->course_id)->count()) > 0
                    ? round(WatchHistory::where([
                        'user_id' => $item->order->customer->id,
                        'course_id' => $item->course_id,
                        'is_completed' => 1,
                    ])->count() / $lessonCount * 100)
                    : 0
            ]);

        return $this->sendResponse($students, 'Students progress retrieved');
    }

    public function destroyCourse(Course $course): JsonResponse
    {
        if (Auth::id() !== $course->instructor_id) {
            return $this->sendError('Unauthorized', 403);
        }

        try {
            $course->delete();
            return $this->sendResponse(null, 'Course deleted successfully');
        } catch (\Exception $e) {
            logger()->error('Destroy course failed: ' . $e->getMessage());
            return $this->sendError('Delete failed', 500);
        }
    }
}
