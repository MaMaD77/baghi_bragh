<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $locales = config('web.locales');

        if ($request->has('locale')) {
            $localeCode = $request->locale;
        } elseif (session('locale')) {
            $localeCode = session('locale.code');
        } elseif (config('app.locale')) {
            $localeCode = config('app.locale');
        }

        $locale = collect($locales)->firstWhere('code', $localeCode);

        if (isset($locale)) {
            session()->put('locale', $locale);
            app()->setLocale($locale['code']);
        }

        return $next($request);
    }
}
