<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BecomeInstructorSection;
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BecomeInstructorSectionController extends Controller
{
    use FileUpload;

    public function index()
    {
        $becomeInstructor = BecomeInstructorSection::first();

        return view('admin.sections.become-instructor.index', compact('becomeInstructor'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'button_text' => ['nullable', 'string', 'max:255'],
            'button_url' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:3000'],
        ]);

        if ($request->hasFile('image')) {
            $image = $this->uploadFile($request->file('image'));
            $this->deleteFile($request->old_image);
            $validateData['image'] = $image;
        }

        BecomeInstructorSection::updateOrCreate(
            [
                'id' => 1,
            ],
            $validateData
        );

        Cache::forget('homepage_instructor_banner');
        notyf()->success('Update Successfully!');

        return redirect()->back();
    }
}
