<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseCategory;
use App\Models\LatestCourseSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LatestCourseSectionController extends Controller
{

    public function index()
    {
        $categories = CourseCategory::all();
        $latestCourseSection = LatestCourseSection::first();
        return view('admin.sections.latest-course.index', compact('categories','latestCourseSection'));
  }    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_one' => ['nullable','integer','exists:course_categories,id'],
            'category_two' => ['nullable','integer','exists:course_categories,id'],
            'category_three' => ['nullable','integer','exists:course_categories,id'],
            'category_four' => ['nullable','integer','exists:course_categories,id'],
            'category_five' => ['nullable','integer','exists:course_categories,id'],
        ]);

        LatestCourseSection::updateOrCreate(['id' => 1], $validatedData);

        Cache::forget('homepage_latest_courses');
        notyf()->success('Latest Course Section Updated Successfully');

        return redirect()->back();
    }
}
