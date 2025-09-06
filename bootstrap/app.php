<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Laravel\Passport\Passport;
use Carbon\Carbon;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function ($middleware) {
        // make it global for APIs, or alias then use in routes
        $middleware->alias([
            'per_page' => \App\Http\Middleware\CapturePerPage::class,
        ]);
    })
    ->withMiddleware(function (Middleware $middleware) {

        $middleware->alias([
            'translation.language' => \App\Http\Middleware\ApplyTranslationLanguage::class,
        ]);


        $middleware->group('api', [
            'translation.language',
            'per_page',
        ]);
    })
   
    ->withExceptions(function (Exceptions $exceptions) {
        Passport::personalAccessTokensExpireIn(Carbon::now()->addMonth());
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(60));
    })
    
    ->create();
