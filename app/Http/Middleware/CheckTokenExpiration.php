<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTokenExpiration
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->user()?->currentAccessToken();

        if ($token && $token->expires_at && $token->expires_at->isPast()) {
            // Optional: delete expired token
            $token->delete();

            return response()->json([
                'message' => 'Your token has expired. Please login again.'
            ], 401);
        }

        return $next($request);
    }
}
