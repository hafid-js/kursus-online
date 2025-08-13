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



    public function index(Request $request)
    {
        $query = CourseCategory::query();

        if ($request->has('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%");
            });
        }
        $query->whereNull('parent_id');

        $categories = $query->paginate(15);

        if ($request->ajax() && $request->has('search')) {
            return view('admin.course.course-category.partials.table', compact('categories'))->render();
        }

        return view('admin.course.course-category.index', compact('categories'));
    }



    public function create()
    {
        $editMode = false;
        return response()->view('admin.course.course-category.partials.category-modal', compact('editMode'));
    }
    // public function edit($id): \Illuminate\Http\Response
    // {
    //     $category = CourseCategory::findOrFail($id);
    //     $editMode = true;
    //     return response()->view('admin.course.course-category.category-modal', compact('category', 'editMode'));
    // }


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

            return response()->json([
                'redirect' => route('admin.course-categories.index')
            ]);
        }
    }



    public function edit($id): \Illuminate\Http\Response
    {
        $category = CourseCategory::findOrFail($id);
        $editMode = true;
        return response()->view('admin.course.course-category.partials.category-modal', compact('category', 'editMode'));
    }


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

        return response()->json([
            'redirect' => route('admin.course-categories.index')
        ]);
    }



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
