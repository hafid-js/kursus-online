<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUsSection;
use App\Traits\FileUpload;
use Illuminate\Http\Request;

class AboutUsSectionController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $about = AboutUsSection::first();
        return view('admin.sections.about-section.index', compact('about'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'rounded_text' => $request->rounded_text,
            'learner_count' => $request->learner_count,
            'learner_count_text' => $request->learner_count_text,
            'title' => $request->title,
            'description' => $request->description,
            'button_text' => $request->button_text,
            'button_url' => $request->button_url,
            'video_url' => $request->video_url,
        ];

        if($request->hasFile('image')) {
            $image = $this->uploadFile($request->file('image'));
            $this->deleteFile($request->old_image);
            $data['image'] = $image;
        }

        if($request->hasFile('learner_image')) {
            $learner_image = $this->uploadFile($request->file('learner_image'));
            $this->deleteFile($request->old_learner_image);
            $data['learner_image'] = $learner_image;
        }

        if($request->hasFile('video_image')) {
            $video_image = $this->uploadFile($request->file('video_image'));
            $this->deleteFile($request->old_video_image);
            $data['video_image'] = $video_image;
        }

        AboutUsSection::updateOrCreate(['id' => 1], $data);

        notyf()->success('Upload Successfully');

        return redirect()->back();
    }
}
