<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseLevel;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CourseLevelController extends Controller
{

    public function index()
    {
        $levels = CourseLevel::paginate(15);
        return view('admin.course.course-level.index', compact('levels'));
    }

     public function create()
    {
         $editMode = false;
        return response()->view('admin.course.course-level.level-modal', compact('editMode'));
    }


    public function store(Request $request) : RedirectResponse
    {
        $request->validate(['name' => ['required', 'max:255','unique:course_levels']]);

        $level = new CourseLevel();
        $level->name = $request->name;
        $level->slug = Str::slug($request->name);
        $level->save();

        notyf()->success('Created Successfully!');

        return to_route('admin.course-levels.index');
    }



    public function edit(CourseLevel $course_level)
    {
        $editMode = true;
        return response()->view('admin.course.course-level.level-modal', compact('course_level', 'editMode'));
    }

    public function update(Request $request, CourseLevel $course_level)
    {
        $request->validate(['name' => ['required', 'max:255','unique:course_levels,name,'.$course_level->id]]);
        $course_level->name = $request->name;
        $course_level->save();

        notyf()->success('Updated Successfully!');

        return to_route('admin.course-levels.index');
    }


    public function destroy(CourseLevel $course_level)
    {
        try {
            // throw ValidationException::withMessages(['you have error']);
            $course_level->delete();
            notyf()->success('Delete Succesfully!');
            return response(['message' => 'Delete Successfully!'], 200);
        } catch(Exception $e) {
            logger("Course Level Error >> ".$e);
            return response(['message' => 'Something went wrong!'], 500);
        }
    }
}
