<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\InstructorRequestApprovedMail;
use App\Mail\InstructorRequestRejectMail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class InstructorRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instructorsRequests = User::where(function ($query) {
            $query->where('approve_status', 'pending')
                ->orWhere('approve_status', 'rejected');
        })->where('role', 'instructor')->get();

        return view('admin.instructor-request.index', compact('instructorsRequests'));
    }

    function download(User $user)
    {
        return response()->download(public_path($user->document));
    }
    function show(User $user)
    {
        $path = public_path($user->document);

    // Dapatkan mime type dari file
    $mime = mime_content_type($path);

    return response()->file($path, [
        'Content-Type' => $mime,
        'Content-Disposition' => 'inline; filename="'.basename($path).'"',
    ]);
    }

    /**
     * Update the specified resource in storage.
     */
  function update(Request $request, User $user)
    {
        $user->approve_status = $request->status;
        $user->save();

        notyf()->success('approved instructor request successfully');
  }    public static function sendNotification($instructor_request) : void {
        switch ($instructor_request->approve_status) {
            case 'approved':
                if (config('mail_queue.is_queue')) {
                    Mail::to($instructor_request->email)->queue(new InstructorRequestApprovedMail());
                } else {
                    Mail::to($instructor_request->email)->send(new InstructorRequestApprovedMail());
                }
                break;

            case 'rejected':
                if (config('mail_queue.is_queue')) {
                    Mail::to($instructor_request->email)->queue(new InstructorRequestRejectMail());
                } else {
                    Mail::to($instructor_request->email)->send(new InstructorRequestRejectMail());
                }
                break;
        }

    }
}
