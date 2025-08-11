<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSetting;
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ContactSettingController extends Controller
{

    use FileUpload;

    public function index()
    {
        $contactSetting = ContactSetting::first();
        return view('admin.contact.contact-setting.index', compact('contactSetting'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => ['nullable','image','max:3000'],
            'map_url' => ['nullable','url']
        ]);

        if($request->hasFile('image')){
            $image = $this->uploadFile($request->file('image'));
            $validatedData['image'] = $image;
        }

        ContactSetting::updateOrCreate(
            ['id' => 1],
            $validatedData
        );

        Cache::forget('contact_setting');
        notyf()->success('Update Successfully!');
        return redirect()->back();
    }
}
