<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CapturePerPage
{
    public function handle(Request $request, Closure $next)
    {
        // accept ?per_page=... or ?limit=...
        $raw = $request->query('per_page', $request->query('limit'));

        if ($raw !== null) {
            $raw = filter_var($raw, FILTER_VALIDATE_INT);
            if ($raw !== false) {
                $min = (int) config('pagination.min', 1);
                $max = (int) config('pagination.max', 100);
                $clamped = max($min, min($max, (int) $raw));

                // store into config for this request
                config(['pagination.per_page' => $clamped]);
            }
        }

        return $next($request);
    }
}
