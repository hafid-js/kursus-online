<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\FeaturedInstructor;
use App\Models\User;
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class FeaturedInstructorController extends Controller
{

    use FileUpload;

    public function index()
    {
                $instructors = User::where('role', 'instructor')->where('approve_status', 'approved')->get();
        $featuredInstructor = FeaturedInstructor::first();
        $selectedCourses = json_decode($featuredInstructor?->featured_courses);
        $selectedInstructorCourses = Course::select(['id', 'title'])->where('instructor_id', $featuredInstructor?->instructor_id)->get();
        return view('admin.sections.featured-instructor.index', compact('instructors', 'featuredInstructor','selectedCourses','selectedInstructorCourses'));
    }

    function getInstructorCourses(String $id) : Response {
        $courses = Course::select(['id','title'])->where('instructor_id', $id)->where('is_approved','approved')->get();
        return response(['courses' => $courses]);
  }    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['required', 'string', 'max:255'],
            'button_text' => ['required', 'string', 'max:255'],
            'button_url' => ['required', 'string', 'max:255'],
            'instructor_id' => ['required', 'exists:users,id'],
            'featured_courses' => ['required', 'array'],
            'featured_courses.*' => ['required', 'exists:courses,id'],
            'instructor_image' => ['nullable', 'image', 'max:3000'],
        ]);

        $validatedData['featured_courses'] = json_encode($validatedData['featured_courses']);

        if($request->hasFile('instructor_image')) {
            $image = $this->uploadFile($request->file('instructor_image'));
            $this->deleteFile($request->old_instructor_image);
            $validatedData['instructor_image'] = $image;
        }

        FeaturedInstructor::updateOrCreate(
            ['id' => 1],
            $validatedData
        );

        Cache::forget('homepage_featured_instructor');

        notyf()->success('Update Successfully!');
        return redirect()->back();
    }
}
