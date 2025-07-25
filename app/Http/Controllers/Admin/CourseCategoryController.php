<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseCategoryStoreRequest;
use App\Http\Requests\Admin\CourseCategoryUpdateRequest;
use App\Models\CourseCategory;
use App\Traits\FileUpload;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseCategoryController extends Controller
{

    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = CourseCategory::whereNull('parent_id')->paginate(15);
        return view('admin.course.course-category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.course.course-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseCategoryStoreRequest $request) : RedirectResponse
    {
        $imagePath = $this->uploadFile($request->file('image'));
        $category = new CourseCategory();
        $category->image = $imagePath;
        $category->name = $request->name;
        $category->slug = Str::of($request->name)->slug('-');
        $category->show_at_trending = $request->show_at_trending ?? 0;
        $category->status = $request->status ?? 0;
        $category->save();

        notyf()->success("Created Successfully!");

        return to_route('admin.course-categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseCategory $course_category)
    {
        return view('admin.course.course-category.edit', compact('course_category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseCategoryUpdateRequest $request, CourseCategory $course_category)
{
    if ($request->hasFile('image')) {
        $image = $this->uploadFile($request->file('image'));
        if ($request->old_image) {
            $this->deleteFile($request->old_image);
        }
        $course_category->image = $image;
    }

    $course_category->name = $request->name;
    $course_category->slug = Str::of($request->name)->slug('-');
    $course_category->show_at_trending = $request->show_at_trending ?? 0;
    $course_category->status = $request->status ?? 0;
    $course_category->save();

    notyf()->success("Updated Successfully!");

    return to_route('admin.course-categories.index');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseCategory $course_category)
    {
        if(CourseCategory::where('parent_id', $course_category->id)->exists()) {
            return response([
                'message' => 'Cannot delete a category with subcategory!'
            ], 422);
        }
        try {
            // throw ValidationException::withMessages(['you have error']);
            $this->deleteFile($course_category->image);
            $course_category->delete();
            notyf()->success('Delete Succesfully!');
            return response(['message' => 'Delete Successfully!'], 200);
        } catch(Exception $e) {
            logger("Course Language Error >> ".$e);
            return response(['message' => 'Something went wrong!'], 500);
        }
    }
}
