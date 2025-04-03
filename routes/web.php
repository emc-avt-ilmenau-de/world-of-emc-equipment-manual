
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\FrontEnd\MinicamController;
use App\Http\Controllers\FrontEnd\DownloadsController;
use App\Http\Controllers\FrontEnd\ThermocamController;
use App\Http\Controllers\FrontEnd\Lamp100Controller;
use App\Http\Controllers\FrontEnd\Lamp75Controller;
use App\Http\Controllers\FrontEnd\Lamp24Controller;
use App\Http\Controllers\FrontEnd\EmcusbController;
use App\Http\Controllers\FrontEnd\LeddriverController;
use App\Http\Controllers\FrontEnd\SequenzerController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\Ordercontroller;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\About1Controller;

// Locale switching
Route::get('/set-locale/{locale}', function ($locale) {
    if (in_array($locale, config('app.available_locales'))) {
        session()->put('locale', $locale);
        App::setLocale($locale);
        Cookie::queue('locale', $locale, 60 * 24 * 30);
        Log::info('Locale changed to: ' . $locale);
    } else {
        Log::warning('Invalid locale attempted: ' . $locale);
    }
    return redirect()->back();
})->name('set.locale');

// Home route with locale setup (moved locale logic to middleware)
Route::get('{locale?}', [ProductController::class, 'index'])
    ->name('home')
    ->where('locale', 'en|de')
    ->middleware(function ($request, $next) {
        $locale = $request->route('locale');
        $available = config('app.available_locales');

        if ($locale && in_array($locale, $available)) {
            App::setLocale($locale);
            session()->put('locale', $locale);
            Cookie::queue('locale', $locale, 60 * 24 * 30);
        } else {
            $locale = session('locale', Cookie::get('locale', config('app.fallback_locale')));
            if (!in_array($locale, $available)) {
                $locale = config('app.fallback_locale');
            }
            App::setLocale($locale);
        }

        Log::info('Request Locale: ' . App::getLocale());
        return $next($request);
    });

// All remaining routes
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
    Route::get('/about', [About1Controller::class, 'index'])->name('about');
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
    Route::post('/product/{id}/submit', [ProductController::class, 'submit'])->name('product.submit');

    Route::prefix('basket')->group(function () {
        Route::get('/', [BasketController::class, 'show'])->name('basket.show');
        Route::post('/add/{id}', [BasketController::class, 'add'])->name('basket.add');
        Route::put('/update/{productId}', [BasketController::class, 'update'])->name('basket.update');
        Route::delete('/remove/{productId}', [BasketController::class, 'remove'])->name('basket.remove');
    });

    Route::post('/order/submit', [Ordercontroller::class, 'submit'])->name('order.submit');
    Route::get('/order/customer-form', [ProductController::class, 'showCustomerForm'])->name('order.customerForm');
    Route::post('/order/customer-submit', [ProductController::class, 'submitCustomerDetails'])->name('order.customerSubmit');
});

Route::get('/debug-test', function () {
    try {
        $testPath = storage_path('logs/test.log');
        if (!file_exists($testPath)) {
            return 'Test log file does not exist.';
        }
        $contents = file_get_contents($testPath);
        return nl2br($contents);
    } catch (\Exception $e) {
        return 'Error accessing test log file: ' . $e->getMessage();
    }
});

Route::get('/test', function () {
    return 'Test route works!';
});
