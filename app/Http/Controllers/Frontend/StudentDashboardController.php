<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\FileUpload;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StudentDashboardController extends Controller
{

    use FileUpload;
    function index() : View {
        return view('frontend.student-dashboard.index');
    }

    function becomeInstructor() {
        if(auth()->user()->role == 'instructor') abort(404);
        return view('frontend.student-dashboard.become-instructor.index');
    }

    function becomeInstructorUpdate(Request $request, User $user) : RedirectResponse {
        $request->validate(['document' => ['required','mimes:pdf,doc,docx,jpg,png','max:1200']]);
        $filePath = $this->uploadFile($request->file('document'));
        $user->update([
            'approve_status' => 'pending',
            'document' => $filePath
        ]);

        return redirect()->route('student.dashboard');
    }
}
