<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseBasicInfoCreateRequest;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseChapter;
use App\Models\CourseLanguage;
use App\Models\CourseLevel;
use App\Models\User;
use App\Traits\FileUpload;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    use FileUpload;
    function index()
    {
        $courses = Course::with(['instructor'])->paginate(25);
        return view('admin.course.course-module.index', compact('courses'));
    }

    // change approve status
    function updateApproval(Request $request, Course $course) {
        $course->is_approved = $request->status;
        $course->save();

        return response([
            'status' => 'success',
            'message' => 'Updated Successfully!'
        ]);
    }

    function create()
    {
        $instructors = User::where('role','instructor')->where('approve_status','approved')->get();
        return view('admin.course.course-module.create', compact('instructors'));
    }

    function storeBasicInfo(CourseBasicInfoCreateRequest $request)
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
            'redirect' => route('admin.courses.edit', ['id' => $course->id, 'step' => $request->next_step])
        ]);
    }

    function edit(Request $request)
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
                $courseId = $request->id;
                $chapters = CourseChapter::where([
                    'course_id' => $courseId
                ])->orderBy('order')->get();
                return view('admin.course.course-module.course-content', compact('courseId', 'chapters'));
                break;

            case '4':
                $course = Course::findOrFail($request->id);
                $editMode = true;
                return view('admin.course.course-module.finish', compact('editMode','course'));
                break;
        }
    }

    function update(Request $request)
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
                    'demo_video_source' => ['nullable']
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
                    'redirect' => route('admin.courses.edit', ['id' => $course->id, 'step' => $request->next_step])
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
                    'language' => ['required', 'integer']
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
                    'redirect' => route('admin.courses.edit', ['id' => $course->id, 'step' => $request->next_step])
                ]);
                break;

            case '3':

                return response([
                    'status' => 'success',
                    'message' => 'Updated Successfully!.',
                    'redirect' => route('admin.courses.edit', ['id' => $request->id, 'step' => $request->next_step])
                ]);

                break;

            case '4':

                            // validation
                            $request->validate([
                                'message' => ['nullable','max:1000','string'],
                                'status' => ['required','in:active,inactive,draft']
                            ]);

                            // update course data
                            $course = Course::findOrFail($request->id);
                            $course->message_for_reviewer = $request->message;
                            $course->status = $request->status;
                            $course->save();

                return response([
                    'status' => 'success',
                    'message' => 'Updated Successfully!.',
                    'redirect' => route('admin.courses.index')
                ]);

                break;
        }
    }
}
