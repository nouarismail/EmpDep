<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Configuration\Exceptions;



return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Register aliases
        $middleware->alias([
            'translation.language' => \App\Http\Middleware\ApplyTranslationLanguage::class,
        ]);

        // Attach middleware to groups
        $middleware->group('api', [
            'translation.language',   // this ensures it runs for every API route
        ]);

        // If you want it on web routes too:
        // $middleware->group('web', [
        //     'translation.language',
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
