<?php

namespace App\Http\Middleware;

class EnsureApiRole
{
    public function handle($request, \Closure $next, ...$roles)
    {
        $user = $request->user();

        if (!$user || !in_array($user->role, $roles)) {
            return response()->json([
                'message' => 'You do not have permission to access this resource with your current role.',
            ], 403);
        }

        return $next($request);
    }
}
