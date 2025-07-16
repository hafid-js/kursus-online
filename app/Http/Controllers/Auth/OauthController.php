<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class OauthController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('gauth_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);

                if ($finduser->role == 'student') {
                    return redirect()->intended(route('student.dashboard', absolute: false));
                } elseif ($finduser->role == 'instructor') {
                    return redirect()->intended(route('instructor.dashboard', absolute: false));
                } else {
                    return abort(404);
                }
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'gauth_id' => $user->id,
                    'gauth_type' => 'google',
                    'password' => Hash::make(Str::random(32)),
                    'role' => 'student',
                    'approve_status' => 'pending'
                ]);

                Auth::login($newUser);

                return redirect('/set-password')->with('email', $newUser->email);

                // return redirect()->intended(route('student.dashboard', absolute: false));
            }
        } catch (Exception $e) {
            \Log::error('Google OAuth Error: ' . $e->getMessage());
            return redirect()->route('login')->with('error', 'Something went wrong with Google login.');
        }
    }

    public function formPassword()
    {
        return view('auth.set-password', [
            'email' => Auth::user()->email,
        ]);
    }

    public function storePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8|confirmed',
        ], [
            'password.confirmed' => 'Password confirmation does not match.',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();

            if ($errors->has('password')) {
                $messages = $errors->get('password');

                foreach ($messages as $key => $message) {
                    if (str_contains($message, 'confirmation')) {
                        $errors->forget('password');

                        $errors->add('password_confirmation', $message);
                    }
                }
            }

            return redirect()->back()
                ->withErrors($errors)
                ->withInput();
        }
        $user = Auth::user();

        $user->password = Hash::make($request->password);
        $user->approve_status = 'approved';
        $user->save();

        Auth::logout();

        return redirect()->route('login')->with('status', 'Your password has been set. Please log in to continue.');
    }
}
