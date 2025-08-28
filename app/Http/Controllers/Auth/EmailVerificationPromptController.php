<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        return $request->user()->hasVerifiedEmail()
            ? redirect()->intended(
                'student' === $request->user()->role
                    ? route('student.dashboard')
                    : ('instructor' === $request->user()->role
                        ? route('instructor.dashboard')
                        : '/')
            )
            : view('auth.verify-email');
    }
}
