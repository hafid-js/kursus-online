<?php

use App\Http\Middleware\CheckRoleMiddleware;
use App\Http\Middleware\EnsureApiRole;
use App\Http\Middleware\EnsureAuthenticatedJson;
use App\Http\Middleware\EnsureDocumentVerified;
use App\Http\Middleware\EnsurePasswordIsSet;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'auth' => Authenticate::class,
            'guest' => RedirectIfAuthenticated::class,
            'check_role' => CheckRoleMiddleware::class,
            'password.set' => EnsurePasswordIsSet::class,
            'verified.document' => EnsureDocumentVerified::class,
            'role' => EnsureApiRole::class, // for api role
            'sanctum' => EnsureFrontendRequestsAreStateful::class,
            'verified.api' => \App\Http\Middleware\EnsureEmailIsVerifiedApi::class,
            'verified.document.api' => \App\Http\Middleware\VerifiedDocumentApiMiddleware::class,


        ]);

         $middleware->group('api', [
            EnsureFrontendRequestsAreStateful::class, // Sanctum middleware
            ThrottleRequests::class.':api',
            SubstituteBindings::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
