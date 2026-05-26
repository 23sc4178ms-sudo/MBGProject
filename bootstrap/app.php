<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpFoundation\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->trustProxies(
            at: '*',
            headers: Request::HEADER_X_FORWARDED_FOR
                | Request::HEADER_X_FORWARDED_HOST
                | Request::HEADER_X_FORWARDED_PORT
                | Request::HEADER_X_FORWARDED_PROTO
        );

        //global middleware
        $middleware->append(\App\Http\Middleware\PromotionMW::class);

        //group middleware
        $middleware->group('group_middleware',[
            \App\Http\Middleware\MiddlewareOne::class,
            \App\Http\Middleware\MiddlewareTWO::class,
        ]);

        //route middleware
        $middleware->alias([
            'maintenance' => \App\Http\Middleware\DownForMaintenanceMW::class,
            'student.auth' => \App\Http\Middleware\StudentAuthenticated::class,
            'role' => \App\Http\Middleware\EnsureRoleAccess::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
