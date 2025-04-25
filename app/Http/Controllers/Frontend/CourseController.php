<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CourseBasicInfoCreateRequest;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    function index() {
        return view('frontend.instructor-dashboard.course.index');
    }

    function create() {
        return view('frontend.instructor-dashboard.course.create');
    }

    function storeBasicInfo(CourseBasicInfoCreateRequest $request) {
        $course = new Course();
        $course->title = $request->title;
        $course->slug = Str::of($request->title)->slug('-');
        $course->seo_description = $request->seo_description;
        $course->thumbnail = '';
        $course->demo_video_storage = $request->demo_video_storage;
        $course->demo_video_source = $request->demo_video_source;
        $course->price = $request->price;
        $course->discount = $request->discount;
        $course->description = $request->description;
        $course->instructor_id = Auth::guard('web')->user()->id;
        $course->save();

        return response([
            'status' => 'success',
            'message' => 'Created Successfully!.'
        ]);

    }
}
