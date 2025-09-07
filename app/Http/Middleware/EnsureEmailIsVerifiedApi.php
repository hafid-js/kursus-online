<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EnsureEmailIsVerifiedApi
{
    public function handle(Request $request, Closure $next): JsonResponse|\Illuminate\Http\Response
    {
        if (!$request->user() || !$request->user()->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'Email address is not verified.'
            ], 403);
        }

        return $next($request);
    }
}
