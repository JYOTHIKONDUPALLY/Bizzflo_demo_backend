<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
            'auth.user' => \App\Http\Middleware\AuthenticateUser::class,
            'auth.customer' => \App\Http\Middleware\AuthenticateCustomer::class,
            'auth.admin' => \App\Http\Middleware\AuthenticateAdmin::class,

        ]);
         $middleware->append(\Illuminate\Http\Middleware\HandleCors::class);
$middleware->api(prepend: [
    \App\Http\Middleware\CorsMiddleware::class,
]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
