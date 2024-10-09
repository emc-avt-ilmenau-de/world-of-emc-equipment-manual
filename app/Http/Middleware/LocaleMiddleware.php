<?php

// app/Http/Middleware/LocaleMiddleware.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class LocaleMiddleware
{
    public function handle($request, Closure $next)
    {
        // Get locale from cookie if it exists
        $locale = $request->cookie('locale', 'en');

        // Log to check if the locale is correctly set
        Log::info('Current locale: ' . $locale);
        
        // Set the application locale
        App::setLocale($locale);

        return $next($request);
    }
}


