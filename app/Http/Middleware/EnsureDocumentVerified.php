<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureDocumentVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        // Jika user punya dokumen (tidak null dan tidak kosong)
        $hasDocument = !empty($user->document);

        if ($hasDocument && $user->document_status !== 'approved') {
            return redirect()->route('instructor.dashboard')->with('error', match ($user->document_status) {
                'pending' => 'Your document is still under verification.',
                'rejected' => 'Your document was rejected. Please upload it again.',
                default => 'Invalid document status. Please contact the administrator.',
            });
        }


        return $next($request);
    }
}
