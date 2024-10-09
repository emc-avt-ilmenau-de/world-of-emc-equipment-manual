<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App; // Add this line
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
use App\Http\Controllers\Productcontroller;
use App\Http\Controllers\LanguageController;

// Route for setting the locale via controller
Route::get('/set-locale/{locale}', [LanguageController::class, 'setLocale'])->name('set-locale');

// Main route for switching locale and rendering the view
Route::get('{locale?}', function ($locale = 'en') {
    App::setLocale($locale);
    
    // Log current session data for debugging
    Log::info('Current Session Data: ', Session::all());
    Log::info('Rendering view with locale: ' . $locale);

    return view('Frontend.index'); // Return your main view
})->name('home')->where('locale', 'en|de');


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


