<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use App\Traits\FileUpload;
use Exception;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{

    public function index()
    {
        $socialLinks = SocialLink::all();
        return view('admin.social-link.index', compact('socialLinks'));
    }


    public function create()
    {
         return view('admin.social-link.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'icon' => ['required','string','max:20'],
            'url' => ['required','url'],
            'status' => ['nullable','boolean'],
        ]);

        $social = new SocialLink();
        $social->icon = $request->icon;
        $social->url = $request->url;
        $social->status = $request->status ?? 0;
        $social->save();

        notyf()->success('Created Successfully!');

        return to_route('admin.social-links.index');
    }



    public function edit(SocialLink $socialLink)
    {
        return view('admin.social-link.edit', compact('socialLink'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'icon' => ['nullable','string','max:30'],
            'url' => ['required','url'],
            'status' => ['nullable','boolean'],
        ]);

        $social = SocialLink::findOrFail($id);

        $social->icon = $request->icon;
        $social->url = $request->url;
        $social->status = $request->status ?? 0;
        $social->save();

        notyf()->success('Updated Successfully!');
        return to_route('admin.social-links.index');
    }


    public function destroy(SocialLink $social_link)
    {
        try {
            $social_link->delete();
            notyf()->success('Deleted Successfully!');
            return response(['message' => 'Deleted Successfully!'],200);
        } catch(Exception $e) {
            logger("Social Link Error >> ".$e);
            return response(['message' => 'Something went wrong!'], 500);
        }
    }
}
