<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = strtolower(substr($request->header('Accept-Language', config('app.locale')), 0, 2));

        if (!in_array($locale, config('app.supported_locales', ['en', 'bn']))) {
            $locale = config('app.locale');
        }

        app()->setLocale($locale);
        return $next($request);
    }
}
