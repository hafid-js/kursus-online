<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create()
    {
        if (Auth::check()) {
            return match (Auth::user()->role) {
                'student' => redirect()->route('student.dashboard'),
                'instructor' => redirect()->route('instructor.dashboard'),
                default => redirect('/'),
            };
        }

        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $key = Str::lower($request->input('email')) . '|' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);

            return back()
                ->withInput()
                ->with('wait_seconds', $seconds)
                ->withErrors(['email' => 'Too many login attempts.']);
        }

        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            $request->session()->regenerate();

            if (!Auth::user()->hasVerifiedEmail()) {
                return redirect()->route('verification.notice')
                    ->with('status', 'Please verify your email before logging in.');
            }
            // $this->logUserInfo($request);
            return match (Auth::user()->role) {
                'student' => redirect()->intended(route('student.dashboard')),
                'instructor' => redirect()->intended(route('instructor.dashboard')),
                default => redirect('/'),
            };
        }


        RateLimiter::hit($key, 120);

        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }

    // public function logUserInfo(Request $request)
    // {
    //     $ip = $request->ip();
    //     $datetime = Carbon::now('UTC');

    //     // Get geolocation
    //     $locationData = Http::get("http://ip-api.com/json/{$ip}")->json();
    //     $country = $locationData['country'] ?? 'Unknown';

    //     // Get browser and OS
    //     $browser = Agent::browser() . ' ' . Agent::version(Agent::browser());
    //     $os = Agent::platform() . ' ' . Agent::version(Agent::platform());

    //     // Get raw user-agent
    //     $userAgentString = $request->header('User-Agent');

    //     // store to database
    //     $log = UserLog::where('user_id', Auth::id())->latest()->first();

    //     if ($log) {
    //         $log->update([
    //             'ip_address' => $ip,
    //             'location' => $country,
    //             'operating_system' => $os,
    //             'browser' => $browser,
    //             'user_agent' => $userAgentString,
    //             'accessed_at' => $datetime,
    //         ]);
    //     } else {
    //         UserLog::create([
    //             'user_id' => Auth::id(),
    //             'ip_address' => $ip,
    //             'location' => $country,
    //             'operating_system' => $os,
    //             'browser' => $browser,
    //             'user_agent' => $userAgentString,
    //             'accessed_at' => $datetime,
    //         ]);
    //     }
    // }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
