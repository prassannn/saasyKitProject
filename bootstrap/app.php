<?php

use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Console\Kernel;

return Illuminate\Foundation\Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->appendToGroup('web', [
            App\Http\Middleware\BlockedUser::class,
            App\Http\Middleware\UpdateUserLastSeenAt::class,
        ]);

        $middleware->alias([
            'sitemapped' => \App\Http\Middleware\Sitemapped::class,
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {})->create();

    app()->booted(function () {
        app(Schedule::class)->command('app:send-rental-expiry-reminders')->daily();
    });
