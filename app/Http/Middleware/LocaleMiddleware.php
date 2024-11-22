<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class LocaleMiddleware
{
    public function handle($request, Closure $next)
    {
        // Get the locale from the session
        $locale = $request->cookie('locale', Session::get('locale', config('app.fallback_locale')));
    
        // Log before setting the locale
        Log::info('LocaleMiddleware: Session Locale Before Setting: ' . $locale);
    
        // Set the application locale
        App::setLocale($locale);
       
        
        // Log after setting the locale
        Log::info('LocaleMiddleware: Application Locale Set To: ' . App::getLocale());
    
        return $next($request);
    }
}


