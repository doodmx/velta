<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

class Language
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

        $locale = app()->getLocale();
        if (session()->has('locale')) {
            $locale = session()->get('locale');
        }


        app()->setLocale($locale);
        setlocale(LC_TIME, $locale);
        Carbon::setLocale($locale);


        return $next($request);
    }
}
