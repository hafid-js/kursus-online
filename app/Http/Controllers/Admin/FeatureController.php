<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FeatureUpdateRequest;
use App\Models\Feature;
use App\Traits\FileUpload;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FeatureController extends Controller
{

    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feature = Feature::first();
        return view('admin.sections.feature.index', compact('feature'));
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
    public function store(FeatureUpdateRequest $request): RedirectResponse
    {
        $data = [
            'title_one' => $request->title_one,
            'title_two' => $request->title_two,
            'title_three' => $request->title_three,
            'subtitle_one' => $request->subtitle_one,
            'subtitle_two' => $request->subtitle_two,
            'subtitle_three' => $request->subtitle_three,
        ];


        if ($request->hasFile('image_one')) {
            $image_one = $this->uploadFile($request->file('image_one'));
            $this->deleteFile($request->old_image_one);
            $data['image_one'] = $image_one;
        }

        if ($request->hasFile('image_two')) {
            $image_two = $this->uploadFile($request->file('image_two'));
            $this->deleteFile($request->old_image_two);
            $data['image_two'] = $image_two;
        }

        if ($request->hasFile('image_three')) {
            $image_three = $this->uploadFile($request->file('image_three'));
            $this->deleteFile($request->old_image_three);
            $data['image_three'] = $image_three;
        }
        Feature::updateOrCreate(
            [
                'id' => 1
            ],
            $data
        );

        notyf()->success("Created Successfully!");

        return redirect()->back();
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
