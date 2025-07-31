<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\HeroUpdateRequest;
use App\Models\Feature;
use App\Models\Hero;
use App\Traits\FileUpload;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HeroController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hero = Hero::first();
        return view('admin.sections.hero.index', compact('hero'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(HeroUpdateRequest $request): RedirectResponse
    {
            $data = [
                'label' => $request->label,
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'button_text' => $request->button_text,
                'button_url' => $request->button_url,
                'video_button_text' => $request->video_button_text,
                'video_button_url' => $request->video_button_url,
                'banner_item_title' => $request->banner_item_title,
                'banner_item_subtitle' => $request->banner_item_subtitle,
                'round_text' => $request->round_text,
            ];

            if($request->hasFile('image')) {
                $image = $this->uploadFile($request->file('image'));
                $this->deleteFile($request->old_image);
                $data['image'] = $image;
            }

            Hero::updateOrCreate(
                [
                    'id' => 1,
                ], $data
                );

                Cache::forget('homepage_hero');

                notyf()->success('Updated Successfully!');
                return redirect()->back();
    }
}
