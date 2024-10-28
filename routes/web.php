<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\FrontEnd\minicamcontroller;
use App\Http\Controllers\FrontEnd\downloadscontroller;
use App\Http\Controllers\FrontEnd\thermocamcontroller;
use App\Http\Controllers\FrontEnd\lamp100controller;
use App\Http\Controllers\FrontEnd\lamp75controller;
use App\Http\Controllers\FrontEnd\lamp24controller;
use App\Http\Controllers\FrontEnd\emcusbcontroller;
use App\Http\Controllers\FrontEnd\leddrivercontroller;
use App\Http\Controllers\FrontEnd\sequenzercontroller;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LanguageController;

// Locale switching route
Route::get('/set-locale/{locale}', function ($locale) {
    if (in_array($locale, config('app.available_locales'))) {
        session()->put('locale', $locale); // Set the locale in the session
        App::setLocale($locale); // Set the locale for the current request
        Cookie::queue('locale', $locale, 60 * 24 * 30); // Set the locale cookie for 30 days
        Log::info('Locale changed to: ' . $locale);
    } else {
        Log::warning('Attempted to set invalid locale: ' . $locale);
    }
    return redirect()->back(); // Redirect back to the previous page
})->name('set.locale');

// Homepage route
Route::get('{locale?}', function ($locale = '') {
    $availableLocales = config('app.available_locales');

    // Check the locale from the URL, session, or cookie
    if (isset($locale) && in_array($locale, $availableLocales)) {
        App::setLocale($locale);
        session()->put('locale', $locale);
        Cookie::queue('locale', $locale, 60 * 24 * 30); // Update the cookie if the locale is set in the URL
    } else {
        $locale = session('locale', Cookie::get('locale', config('app.fallback_locale')));
        App::setLocale($locale);
    }

    Log::info('Request Locale: ' . App::getLocale()); // Log the current locale
    return view('Frontend.index'); // Return your main view
})->name('home')->where('locale', 'en|de');

// Other routes without locale constraints
// Middleware applied to all routes
Route::middleware(['web', \App\Http\Middleware\LocaleMiddleware::class])->group(function () {
   
    Route::get('/minicam', [minicamcontroller::class, 'index']);
    Route::get('/downloads', [downloadscontroller::class, 'index']);
    Route::get('/thermocam', [thermocamcontroller::class, 'index']);
    Route::get('/lamp100',[lamp100controller::class, 'index']);
    Route::get('/lamp75',[lamp75controller::class, 'index']);
    Route::get('/lamp24',[lamp24controller::class, 'index']);
    Route::get('/emcusb',[emcusbcontroller::class, 'index']);
    Route::get('/leddriver',[leddrivercontroller::class, 'index']);
    Route::get('/sequenzer',[sequenzercontroller::class, 'index']);
    Route::get('/about', [ProductController::class, 'index'])->name('about');
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
    Route::post('/product/{id}/submit', [ProductController::class, 'submit'])->name('product.submit');
 // Other routes...
});


/*// Default Route Handling
Route::get('/{any}', function () {
    return view('Frontend.index');
})->where('any', '.*');

*/
/*Route::get('/switch-language/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'de'])) {
        Session::put('locale', $locale);  // Store the locale in session
    }
    return redirect()->back();  // Redirect to the previous page
})->name('switchLang');

*/

/*Route::get('lang/{locale}', function ($locale) {
    // Ensure the locale exists in your supported locales
    if (! in_array($locale, ['en', 'de'])) {
        abort(400);
    }

    // Store the selected locale in session
    session(['locale' => $locale]);

    // Redirect back to the previous page
    return redirect()->back();
});*/


