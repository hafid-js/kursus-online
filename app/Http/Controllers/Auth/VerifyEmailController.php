<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            Auth::logout();
            return Redirect::route('login')->with('status', 'Your account has been verified, please login.');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));

            // Update approve_status after verification email
            $request->user()->update([
                'approve_status' => 'approved',
            ]);

            Auth::logout();
        }

        return Redirect::route('login')->with('status', 'Your account has been verified, please login.');
    }
}
