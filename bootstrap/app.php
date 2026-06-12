<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
        // Guests trying to access auth-protected pages
        $middleware->redirectGuestsTo('/');

        // Authenticated users trying to access guest-only pages
        $middleware->redirectUsersTo('/dashboard');

        $middleware->appendToGroup('web', [
            \App\Http\Middleware\PreventBackHistory::class,
        ]);

         $middleware->alias([
            'isAdmin' => \App\Http\Middleware\IsAdmin::class,
            'isTechnician' => \App\Http\Middleware\IsTechnician::class,
            'isCustomer' => \App\Http\Middleware\IsCustomer::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
