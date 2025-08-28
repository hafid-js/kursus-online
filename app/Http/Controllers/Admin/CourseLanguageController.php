<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CourseLanguageDataTable;
use App\Http\Controllers\Controller;
use App\Models\CourseLanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CourseLanguageController extends Controller
{
    public function index(CourseLanguageDataTable $dataTable)
    {
        return $dataTable->render('admin.course.course-language.index');
    }

    public function create()
    {
        $editMode = false;

        return response()->view('admin.course.course-language.partials.language-modal', compact('editMode'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => ['required', 'max:255', 'unique:course_languages']]);

        $language = new CourseLanguage();
        $language->name = $request->name;
        $language->slug = Str::slug($request->name);
        $language->save();

        notyf()->success('Created Successfully!');

        return response()->json([
            'redirect' => route('admin.course-languages.index'),
        ]);
    }

    public function edit(CourseLanguage $course_language)
    {
        $editMode = true;

        return response()->view('admin.course.course-language.partials.language-modal', compact('course_language', 'editMode'));
    }

    public function update(Request $request, CourseLanguage $course_language)
    {
        $request->validate(['name' => ['required', 'max:255', 'unique:course_languages,name,' . $course_language->id]]);
        $course_language->name = $request->name;
        $course_language->save();

        notyf()->success('Updated Successfully!');

        return to_route('admin.course-languages.index');
    }

    public function destroy(CourseLanguage $course_language)
    {
        try {
            // throw ValidationException::withMessages(['you have error']);
            $course_language->delete();
            notyf()->success('Delete Succesfully!');

            return response(['message' => 'Delete Successfully!'], 200);
        } catch (\Exception $e) {
            logger('Course Language Error >> ' . $e);

            return response(['message' => 'Something went wrong!'], 500);
        }
    }
}
