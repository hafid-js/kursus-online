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
        $instructorRequests = User::whereIn('role', ['student', 'instructor'])
            ->whereNotNull('document')
            ->where('document', '!=', '')
            ->where('document_status', 'pending')
            ->get();



        return view('admin.instructor-request.index', compact('instructorRequests'));
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
            'Content-Disposition' => 'inline; filename="' . basename($path) . '"',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    function update(Request $request, User $user)
    {
        $user->document_status = $request->status;
        if($user->role === 'student' && $user->document_status === 'approved'){
            $user->role = 'instructor';
        }
        $user->save();

        self::sendNotification($user);
        notyf()->success('approved instructor request successfully');
    }
    public static function sendNotification($user): void
    {
        switch ($user->document_status) {
            case 'approved':
                if (config('mail_queue.is_queue')) {
                    Mail::to($user->email)->queue(new InstructorRequestApprovedMail());
                } else {
                    Mail::to($user->email)->send(new InstructorRequestApprovedMail());
                }
                break;

            case 'rejected':
                if (config('mail_queue.is_queue')) {
                    Mail::to($user->email)->queue(new InstructorRequestRejectMail());
                } else {
                    Mail::to($user->email)->send(new InstructorRequestRejectMail());
                }
                break;
        }
    }
}
