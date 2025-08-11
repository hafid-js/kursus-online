<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseCategoryStoreRequest;
use App\Http\Requests\Admin\CourseSubCategoryStoreRequest;
use App\Http\Requests\Admin\CourseSubCategoryUpdateRequest;
use App\Models\CourseCategory;
use App\Traits\FileUpload;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class CourseSubCategoryController extends Controller
{

    use FileUpload;

    public function index(CourseCategory $course_category)
    {

        $subCategories = CourseCategory::where('parent_id', $course_category->id)->get();
        return view('admin.course.course-sub-category.index', compact('course_category', 'subCategories'));
    }


    // CourseSubCategoryController.php
    public function create($course_category_id): Response
    {
        $category = CourseCategory::findOrFail($course_category_id);
        $categoryId = $category->id;
        $editMode = false;
        return response()->view('admin.course.course-sub-category.sub-category-modal', compact('categoryId', 'editMode'));
    }


    public function store(CourseCategoryStoreRequest $request, CourseCategory $course_category)
    {


        $category = new CourseCategory();

        if ($request->hasFile('image')) {
            $imagePath = $this->uploadFile($request->file('image'));
            $category->image = $imagePath;
        }
        $category->name = $request->name;
        $category->slug = Str::of($request->name)->slug('-');
        $category->parent_id = $course_category->id;
        $category->show_at_trending = $request->show_at_trending ?? 0;
        $category->status = $request->status ?? 0;
        $category->save();

        notyf()->success("Created Successfully!");

        return response()->json([
            'redirect' => route('admin.course-sub-categories.index', $course_category)
        ]);
    }

    public function edit(CourseCategory $course_category, CourseCategory $course_sub_category)
    {
        $editMode = true;

        return response()->view('admin.course.course-sub-category.sub-category-modal', compact('course_category', 'course_sub_category', 'editMode'));
    }

    public function update(CourseSubCategoryUpdateRequest $request, CourseCategory $course_category, CourseCategory $course_sub_category)
    {
        $category = $course_sub_category;

        if ($request->hasFile('image')) {
            $imagePath = $this->uploadFile($request->file('image'));
            $this->deleteFile($category->image);
            $category->image = $imagePath;
        }
        $category->name = $request->name;
        $category->slug = Str::of($request->name)->slug('-');
        $category->parent_id = $course_category->id;
        $category->show_at_trending = $request->show_at_trending ?? 0;
        $category->status = $request->status ?? 0;
        $category->save();

        notyf()->success("Updated Successfully!");

        return to_route('admin.course-sub-categories.index', $course_category->id);
    }


    public function destroy(CourseCategory $course_category, CourseCategory $course_sub_category)
    {
        try {
            // throw ValidationException::withMessages(['you have error']);
            $this->deleteFile($course_sub_category->image);
            $course_sub_category->delete();
            notyf()->success('Delete Succesfully!');
            return response(['message' => 'Delete Successfully!'], 200);
        } catch (Exception $e) {
            logger("Course Level Error >> " . $e);
            return response(['message' => 'Something went wrong!'], 500);
        }
    }
}
