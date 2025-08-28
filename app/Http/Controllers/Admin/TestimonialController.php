<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TestimonialController extends Controller
{
    use FileUpload;

    public function index()
    {
        $testimonials = Testimonial::paginate(20);

        return view('admin.sections.testimonial.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.sections.testimonial.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'rating' => ['required', 'numeric'],
            'review' => ['required', 'string', 'max:1000'],
            'name' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image', 'max:3000'],
        ]);

        $image = $this->uploadFile($request->file('image'));

        $testimonial = new Testimonial();
        $testimonial->rating = $request->rating;
        $testimonial->review = $request->review;
        $testimonial->user_image = $image;
        $testimonial->user_name = $request->name;
        $testimonial->user_title = $request->title;
        $testimonial->save();

        Cache::forget('homepage_testimonials');
        notyf()->success('Created Successfully!');

        return redirect()->route('admin.testimonial-section.index');
    }

    public function edit(Testimonial $testimonial_section)
    {
        return view('admin.sections.testimonial.edit', compact('testimonial_section'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'rating' => ['required', 'numeric'],
            'review' => ['required', 'string', 'max:1000'],
            'name' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:3000'],
        ]);

        $testimonial = Testimonial::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $this->uploadFile($request->file('image'));
            $this->deleteFile($request->old_image);
            $testimonial->user_image = $image;
        }
        $testimonial->rating = $request->rating;
        $testimonial->review = $request->review;
        $testimonial->user_name = $request->name;
        $testimonial->user_title = $request->title;
        $testimonial->save();

        Cache::forget('homepage_testimonials');
        notyf()->success('Created Successfully!');

        return redirect()->route('admin.testimonial-section.index');
    }

    public function destroy(Testimonial $testimonial_section)
    {
        try {
            // throw ValidationException::withMessages(['you have error']);
            $this->deleteFile($testimonial_section->image);
            $testimonial_section->delete();
            Cache::forget('homepage_testimonials');
            notyf()->success('Delete Succesfully!');

            return response(['message' => 'Delete Successfully!'], 200);
        } catch (\Exception $e) {
            logger('Course Language Error >> ' . $e);

            return response(['message' => 'Something went wrong!'], 500);
        }
    }
}
