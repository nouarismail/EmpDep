<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;



class ApplyTranslationLanguage
{
    public function handle($request, Closure $next)
    {
        
        $langId = $request->header('translation_language_id', 2);

        // Store it in the container
        app()->instance('translation_language_id', $langId);

        return $next($request);
    }
}
