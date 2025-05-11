<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CoursePageController extends Controller
{
    function index() {
        $courses = Course::where('is_approved','approved')->paginate(12);
        return view('frontend.pages.course-page', compact('courses'));
    }
}
