<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CourseDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseBasicInfoCreateRequest;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseChapter;
use App\Models\CourseChapterLession;
use App\Models\CourseLanguage;
use App\Models\CourseLevel;
use App\Models\User;
use App\Traits\FileUpload;
use Exception;
use Flasher\Laravel\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    use FileUpload;
    // function index()
    // {
    //     $courses = Course::with(['instructor'])->paginate(25);
    //     return view('admin.course.course-module.index', compact('courses'));
    // }

    public function index(CourseDataTable $dataTable)
    {
        return $dataTable->render('admin.course.course-module.index');
    }

    // change approve status
    public function updateApproval(Request $request, Course $course)
    {
        $course->is_approved = $request->status;

        if ('pending' == $request->status || 'rejected' == $request->status) {
            $course->status = 'inactive';
        } elseif ('approved' == $request->status) {
            $course->status = 'active';
        }

        $course->save();

        return response([
            'status' => 'success',
            'message' => 'Updated Successfully!',
        ]);
    }

    public function create()
    {
        $instructors = User::where('role', 'instructor')->where('approve_status', 'approved')->get();

        return view('admin.course.course-module.create', compact('instructors'));
    }

    public function storeBasicInfo(CourseBasicInfoCreateRequest $request)
    {
        $thumbnailPath = $this->uploadFile($request->file('thumbnail'));
        $course = new Course();
        $course->title = $request->title;
        $course->slug = Str::of($request->title)->slug('-');
        $course->seo_description = $request->seo_description;
        $course->thumbnail = $thumbnailPath;
        $course->demo_video_storage = $request->demo_video_storage;
        $course->demo_video_source = $request->demo_video_source;
        $course->price = $request->price;
        $course->discount = $request->discount;
        $course->description = $request->description;
        $course->instructor_id = $request->instructor;
        $course->save();

        // save course id on session
        Session::put('course_create_id', $course->id);

        return response([
            'status' => 'success',
            'message' => 'Updated Successfully!.',
            'redirect' => route('admin.courses.edit', ['id' => $course->id, 'step' => $request->next_step]),
        ]);
    }

    public function edit(Request $request)
    {
        switch ($request->step) {
            case '1':
                $course = Course::findOrFail($request->id);

                return view('admin.course.course-module.edit', compact('course'));
                break;

            case '2':
                $categories = CourseCategory::where('status', 1)->get();
                $levels = CourseLevel::all();
                $languages = CourseLanguage::all();
                $course = Course::findOrFail($request->id);

                return view('admin.course.course-module.more-info', compact('categories', 'levels', 'languages', 'course'));
                break;

            case '3':
                $course = Course::findOrFail($request->id);
                $chapters = CourseChapter::where([
                    'course_id' => $course->id,
                ])->orderBy('order')->get();
                $editMode = true;

                return view('admin.course.course-module.course-content', compact('course', 'chapters', 'editMode'));
                break;

            case '4':
                $course = Course::findOrFail($request->id);
                $editMode = true;

                return view('admin.course.course-module.finish', compact('editMode', 'course'));
                break;
        }
    }

    public function update(Request $request)
    {
        switch ($request->current_step) {
            case '1':
                $rules = [
                    'title' => ['required', 'max:255', 'string'],
                    'seo_description' => ['nullable', 'max:255', 'string'],
                    'demo_video_storage' => ['nullable', 'in:youtube,vimeo,external_link,upload', 'string'],
                    'price' => ['required', 'numeric'],
                    'discount' => ['nullable', 'numeric'],
                    'description' => ['required'],
                    'thumbnail' => ['nullable', 'image', 'max:3000'],
                    'demo_video_source' => ['nullable'],
                ];

                if ($request->filled('file')) {
                    $rules['file'] = ['required', 'string'];
                } else {
                    $rules['url'] = ['required', 'string'];
                }

                $request->validate($rules);

                // update course data
                $course = Course::findOrFail($request->id);

                if ($request->hasFile('thumbnail')) {
                    $thumbnailPath = $this->uploadFile($request->file('thumbnail'));
                    $this->deleteFile($course->thumbnail);
                    $course->thumbnail = $thumbnailPath;
                }

                $course->title = $request->title;
                $course->slug = Str::of($request->title)->slug('-');
                $course->seo_description = $request->seo_description;
                $course->demo_video_storage = $request->demo_video_storage;
                $course->demo_video_source = $request->filled('file') ? $request->file : $request->url;
                $course->price = $request->price;
                $course->discount = $request->discount;
                $course->description = $request->description;
                $course->instructor_id = $course->instructor->id;
                $course->save();

                // save course id on session
                Session::put('course_create_id', $course->id);

                return response([
                    'status' => 'success',
                    'message' => 'Updated Successfully!.',
                    'redirect' => route('admin.courses.edit', ['id' => $course->id, 'step' => $request->next_step]),
                ]);
                break;

            case '2':
                // validation
                $request->validate([
                    'capacity' => ['nullable', 'numeric'],
                    'duration' => ['required', 'numeric'],
                    'qna' => ['nullable', 'boolean'],
                    'certificate' => ['nullable', 'boolean'],
                    'category' => ['required', 'integer'],
                    'level' => ['required', 'integer'],
                    'language' => ['required', 'integer'],
                ]);

                // update course data
                $course = Course::findOrFail($request->id);
                $course->capacity = $request->capacity;
                $course->duration = $request->duration;
                $course->qna = $request->qna ? 1 : 0;
                $course->certificate = $request->certificate ? 1 : 0;
                $course->category_id = $request->category;
                $course->course_level_id = $request->level;
                $course->course_language_id = $request->language;
                $course->save();

                return response([
                    'status' => 'success',
                    'message' => 'Updated Successfully!.',
                    'redirect' => route('admin.courses.edit', ['id' => $course->id, 'step' => $request->next_step]),
                ]);
                break;

            case '3':
                // validation
                $request->validate([
                    'id' => ['required', 'integer', 'exists:lessons,id'],
                    'title' => ['required', 'string', 'max:255'],
                    'source' => ['required', 'string', 'in:upload,youtube,vimeo,external'],
                    'file' => ['nullable', 'string'],
                    'url' => ['nullable', 'string'],
                    'file_type' => ['nullable', 'string'],
                    'duration' => ['required', 'string'],
                    'is_preview' => ['nullable', 'boolean'],
                    'downloadable' => ['nullable', 'boolean'],
                    'description' => ['required', 'string'],
                    'course_id' => ['required', 'integer', 'exists:courses,id'],
                    'next_step' => ['required', 'integer'], // step untuk redirect
                ]);

                // Ambil lesson milik user
                $lesson = CourseChapterLession::where('id', $request->id)
                    ->where('instructor_id', Auth::id())
                    ->firstOrFail();

                // Tentukan file_path dari source
                $filePath = 'upload' === $request->source ? $request->file : $request->url;

                // Update data lesson
                $lesson->title = $request->title;
                $lesson->storage = $request->source;
                $lesson->file_path = $filePath;
                $lesson->file_type = $request->file_type;
                $lesson->duration = $request->duration;
                $lesson->is_preview = $request->has('is_preview') ? 1 : 0;
                $lesson->downloadable = $request->has('downloadable') ? 1 : 0;
                $lesson->description = $request->description;
                $lesson->save();

                // Kembalikan response untuk frontend (AJAX atau redirect)
                return response([
                    'status' => 'success',
                    'message' => 'Updated Successfully Bro!',
                    'redirect' => route('admin.courses.edit', [
                        'id' => $request->course_id,
                        'step' => $request->next_step,
                    ]),
                ]);

                break;

            case '4':
                // validation
                $request->validate([
                    'message' => ['nullable', 'max:1000', 'string'],
                    'status' => ['required', 'in:active,inactive,draft'],
                ]);

                // update course data
                $course = Course::findOrFail($request->id);
                $course->message_for_reviewer = $request->message;
                $course->status = $request->status;
                $course->save();

                notyf()->success('Updated Successfuly!');

                return response([
                    'status' => 'success',
                    'message' => 'Updated Successfully!.',
                    'redirect' => route('admin.courses.index'),
                ]);

                break;
        }
    }

    // public function destroy(Course $course)
    //     {
    //         try {
    //             // throw ValidationException::withMessages(['you have error']);
    //             $course->delete();
    //             notyf()->success('Delete Succesfully!');
    //             return response(['message' => 'Delete Successfully!'], 200);
    //         } catch(Exception $e) {
    //             logger("Course Error >> ".$e);
    //             return response(['message' => 'Something went wrong!'], 500);
    //         }
    //     }
}
