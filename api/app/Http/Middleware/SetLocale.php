<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->hasHeader('Accept-Language')) {
            $locale = $request->header('Accept-Language');
            if (!in_array($locale, ['de', 'fr', 'it'])) {
                $locale = "de";
            }
            App::setLocale($locale);
        }
        return $next($request);
    }
}
