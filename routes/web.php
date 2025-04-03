
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\aboutcontroller;
use App\Http\Controllers\FrontEnd\minicamcontroller;
use App\Http\Controllers\FrontEnd\downloadscontroller;
use App\Http\Controllers\FrontEnd\thermocamcontroller;
use App\Http\Controllers\FrontEnd\lamp100controller;
use App\Http\Controllers\FrontEnd\lamp75controller;
use App\Http\Controllers\FrontEnd\lamp24controller;
use App\Http\Controllers\FrontEnd\emcusbcontroller;
use App\Http\Controllers\FrontEnd\leddrivercontroller;
use App\Http\Controllers\FrontEnd\sequenzercontroller;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\Ordercontroller;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\About1Controller;

// Locale switching route
Route::get('/set-locale/{locale}', function ($locale) {
    if (in_array($locale, config('app.available_locales'))) {
        session()->put('locale', $locale);
        App::setLocale($locale);
        Cookie::queue('locale', $locale, 60 * 24 * 30);
        Log::info('Locale changed to: ' . $locale);
    } else {
        Log::warning('Attempted to set invalid locale: ' . $locale);
    }
    return redirect()->back();
})->name('set.locale');

// ✅ All routes wrapped under optional {locale} prefix
Route::prefix('{locale?}')
    ->where(['locale' => 'en|de'])
    ->middleware(['web', \App\Http\Middleware\LocaleMiddleware::class])
    ->group(function () {

    // ✅ Homepage
    Route::get('/', function () {
        $categories = DB::table('Category')->get();
        $productcontroller = new ProductController();
        return $productcontroller->index();
    })->name('home');

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

// Debug route (outside locale prefix)
Route::get('/debug-test', function () {
    try {
        $testPath = storage_path('logs/test.log');
        if (!file_exists($testPath)) {
            return 'Test log file does not exist.';
        }
        return nl2br(file_get_contents($testPath));
    } catch (\Exception $e) {
        return 'Error accessing test log file: ' . $e->getMessage();
    }
});

Route::get('/test', function () {
    return 'Test route works!';
});
