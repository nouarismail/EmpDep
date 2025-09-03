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
        
        $middleware->alias([
            'translation.language' => \App\Http\Middleware\ApplyTranslationLanguage::class,
        ]);

        
        $middleware->group('api', [
            'translation.language',   
        ]);

       
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
