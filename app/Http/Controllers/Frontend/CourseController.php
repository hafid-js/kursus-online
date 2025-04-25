<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    function index() {
        return view('frontend.instructor-dashboard.course.index');
    }

    function create() {
        return view('frontend.instructor-dashboard.course.create');
    }
}
