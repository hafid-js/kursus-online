<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    function index() {
        return view('frontend.student-dashboard.profile.index');
    }

    function profileUpdate(ProfileUpdateRequest $request) : RedirectResponse {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->bio = $request->about;
        $user->headline = $request->headline;
        $user->gender = $request->gender;
        $user->save();

        return redirect()->back();
    }
}
