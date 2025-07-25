<?php

use App\Http\Middleware\CheckRoleMiddleware;
use App\Http\Middleware\EnsurePasswordIsSet;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

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
            'role' => \App\Http\Middleware\EnsureApiRole::class // for api role
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
