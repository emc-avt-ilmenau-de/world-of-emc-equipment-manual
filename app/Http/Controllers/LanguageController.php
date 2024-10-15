<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;


class LanguageController extends Controller
{
    public function setLocale($locale)
    {
        $availableLocales = config('app.available_locales');
    
        if (in_array($locale, $availableLocales)) {
            session(['locale' => $locale]);
            App::setLocale($locale); // Update the application locale
            Cookie::queue('locale', $locale, 60 * 24 * 30); // Store the locale in a cookie for 30 days
            Log::info('Locale set to: ' . $locale);
            Log::info('Current Session Locale: ' . session('locale'));
        } else {
            Log::warning('Attempted to set invalid locale: ' . $locale);
        }
    
        return redirect()->back(); // Redirect back to the previous page
    }

}
