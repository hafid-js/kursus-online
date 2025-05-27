<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\PasswordUpdateRequest;
use App\Http\Requests\Frontend\ProfileUpdateRequest;
use App\Http\Requests\Frontend\SocialUpdateRequest;
use App\Models\PayoutGateway;
use App\Traits\FileUpload;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    use FileUpload;
    function index() {
        return view('frontend.student-dashboard.profile.index');
    }

    function instructorIndex() {
        $gateways = PayoutGateway::where('status', 1)->get();
        return view('frontend.instructor-dashboard.profile.index', compact('gateways'));
    }

    function profileUpdate(ProfileUpdateRequest $request) : RedirectResponse {
        $user = Auth::user();

        if($request->hasFile('avatar')) {
            $avatarPath = $this->uploadFile($request->file('avatar'));
            $this->deleteFile($user->image);
            $user->image = $avatarPath;

        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->bio = $request->about;
        $user->headline = $request->headline;
        $user->gender = $request->gender;
        $user->save();

        notyf()->success('Update Successfully');

        return redirect()->back();
    }

    function updatePassword(PasswordUpdateRequest $request) : RedirectResponse {
        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $user->save();

        notyf()->success('Update Successfully');

        return redirect()->back();

    }

    function updateSocial(SocialUpdateRequest $request) : RedirectResponse {
        $user = Auth::user();
        $user->facebook = $request->facebook;
        $user->x = $request->x;
        $user->linkedin = $request->linkedin;
        $user->website = $request->website;
        $user->save();

        notyf()->success('Update Successfully');

        return redirect()->back();

    }
}
