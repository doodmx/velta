<?php

namespace App\Http\Middleware;

use Closure;

class ApiLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->hasHeader('locale')) {

            app()->setLocale($request->header('locale'));
        } else {
            app()->setLocale('es');
        }
        return $next($request);
    }
}
