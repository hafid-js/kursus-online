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
use Illuminate\Support\Facades\Cache;
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
    public function store(CourseCategoryStoreRequest $request)
    {
        $imagePath = $this->uploadFile($request->file('image'));
        $background = $this->uploadFile($request->file('background'));
        $category = new CourseCategory();
        $category->image = $imagePath;
        $category->background = $background;
        $category->name = $request->name;
        $category->slug = Str::of($request->name)->slug('-');
        $category->show_at_trending = $request->show_at_trending ?? 0;
        $category->status = $request->status ?? 0;
        $category->save();

        Cache::forget('homepage_feature_categories');

        if ($request->ajax()) {
            notyf()->success('Created Succesfully!');
            return response()->json([
                'message' => 'Created Successfully!',
                'redirect' => route('admin.course-categories.index'),
            ]);

            return to_route('admin.course-categories.index');
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): \Illuminate\Http\Response
    {
        $category = CourseCategory::findOrFail($id);
        $editMode = true;
        return response()->view('admin.course.course-category.course-category-modal', compact('category', 'editMode'));
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
        if ($request->hasFile('background')) {
            $background = $this->uploadFile($request->file('background'));
            if ($request->old_background) {
                $this->deleteFile($request->old_background);
            }
            $course_category->background = $background;
        }

        $course_category->name = $request->name;
        $course_category->slug = Str::of($request->name)->slug('-');
        $course_category->show_at_trending = $request->show_at_trending ?? 0;
        $course_category->status = $request->status ?? 0;
        $course_category->save();

        Cache::forget('homepage_feature_categories');
        notyf()->success("Updated Successfully!");

        return to_route('admin.course-categories.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseCategory $course_category)
    {
        if (CourseCategory::where('parent_id', $course_category->id)->exists()) {
            return response([
                'message' => 'Cannot delete a category with subcategory!'
            ], 422);
        }
        try {
            // throw ValidationException::withMessages(['you have error']);
            $this->deleteFile($course_category->image);
            $course_category->delete();
            Cache::forget('homepage_feature_categories');
            notyf()->success('Delete Succesfully!');
            return response(['message' => 'Delete Successfully!'], 200);
        } catch (Exception $e) {
            logger("Course Language Error >> " . $e);
            return response(['message' => 'Something went wrong!'], 500);
        }
    }
}
