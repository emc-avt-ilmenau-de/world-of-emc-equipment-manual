<?php

use App\Http\Controllers\aboutcontroller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

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
use App\Http\Controllers\Basketcontroller;
use App\Http\Controllers\Ordercontroller;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ProductController;



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
Route::get('{locale?}', function ($locale = null) {
    $availableLocales = config('app.available_locales');

    if ($locale && in_array($locale, $availableLocales)) {
        App::setLocale($locale);
        session()->put('locale', $locale);
        Cookie::queue('locale', $locale, 60 * 24 * 30);
    } else {
        $locale = session('locale', Cookie::get('locale', config('app.fallback_locale')));
        if (!in_array($locale, $availableLocales)) {
            $locale = config('app.fallback_locale');
        }
        App::setLocale($locale);
    }

    Log::info('Request Locale: ' . App::getLocale());
    $categories = DB::table('Category')->get();

    // Fetch products using the controller
    $Productcontroller = new ProductController();
    return $ProductController->index();
})->name('home')->where('locale', 'en|de');

// Other routes without locale constraints
// Middleware applied to all routes
Route::middleware(['web', \App\Http\Middleware\LocaleMiddleware::class])->group(function () {

    Route::get('/minicam', [MinicamController::class, 'index']);
    Route::get('/downloads', [DownloadsController::class, 'index']);
    Route::get('/partner', [PartnerController::class, 'index']);
    Route::get('/thermocam', [ThermocamController::class, 'index']);
    Route::get('/lamp100', [Lamp100Controller::class, 'index']);
    Route::get('/lamp75', [Lamp75Controller::class, 'index']);
    Route::get('/lamp24', [Lamp24Controller::class, 'index']);
    Route::get('/emcusb', [EmcusbController::class, 'index']);
    Route::get('/leddriver', [LeddriverController::class, 'index']);
    Route::get('/sequenzer', [SequenzerController::class, 'index']);
    Route::get('/about', [aboutcontroller::class, 'index'])->name('about');
    Route::get('/product/{id}', [Productcontroller::class, 'show'])->name('product.show');
    Route::post('/product/{id}/submit', [Productcontroller::class, 'submit'])->name('product.submit');

    Route::prefix('basket')->group(function () {
        Route::get('/', [Basketcontroller::class, 'show'])->name('basket.show');
        Route::post('/add/{id}', [Basketcontroller::class, 'add'])->name('basket.add');
        Route::put('/update/{productId}', [Basketcontroller::class, 'update'])->name('basket.update');
        Route::delete('/remove/{productId}', [Basketcontroller::class, 'remove'])->name('basket.remove');  // Keep this route inside the group
    });

    // New order submission routes
    Route::post('/order/submit', [Ordercontroller::class, 'submit'])->name('order.submit');
    Route::get('/order/customer-form', [Productcontroller::class, 'showCustomerForm'])->name('order.customerForm');
    Route::post('/order/customer-submit', [Productcontroller::class, 'submitCustomerDetails'])->name('order.customerSubmit');


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
