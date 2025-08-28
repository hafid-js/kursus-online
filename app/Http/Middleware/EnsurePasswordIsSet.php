<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

class EnsurePasswordIsSet
{
    public function handle($request, \Closure $next)
    {
        $user = Auth::user();

        // Jika belum login, lanjutkan ke middleware auth
        if (!$user) {
            return redirect()->route('login');
        }

        // Cek apakah password masih default atau belum diset user
        if ('approved' !== $user->approve_status) {
            return redirect()->route('set.password')->with('warning', 'Please set your password first.');
        }

        return $next($request);
    }
}
