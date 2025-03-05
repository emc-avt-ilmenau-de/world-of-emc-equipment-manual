<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use App\Models\Category;
use App\Models\Product;

class ViewComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->booted(function () {
            if (!Schema::hasTable('Category') || !Schema::hasTable('Product')) {
                Log::error("❌ Tables not found: Category or Product");
                View::share('categories', collect());
                return;
            }

            // Fetch locale **after Laravel has booted**
            $locale = strtolower(trim(session('locale', Cookie::get('locale', config('app.fallback_locale')))));

            Log::info("🌍 Locale Used: " . $locale);

            // Retrieve categories with related products
            $categories = Category::with('products')->get()->map(function ($category) use ($locale) {
                // Decode JSON category name safely
                $decodedCategory = is_string($category->CategoryName)
                    ? json_decode($category->CategoryName, true)
                    : $category->CategoryName;

                if (!is_array($decodedCategory)) {
                    $decodedCategory = [];
                }

                $category->CategoryName = $decodedCategory[$locale]['CategoryName']
                    ?? ($decodedCategory['en']['CategoryName'] ?? 'Unnamed Category');

                // Ensure product model is being used
                $category->products = $category->products->map(function ($product) use ($locale) {
                    Log::info("🔍 Processing Product ID: " . $product->ProductID);

                    // Ensure JSON decoding is safe
                    $decodedProduct = is_string($product->ProductName)
                        ? json_decode($product->ProductName, true)
                        : $product->ProductName;

                    if (!is_array($decodedProduct)) {
                        $decodedProduct = [];
                    }

                    // Extract product name
                    $product->LocalizedProductName = $decodedProduct[$locale]['ProductName']
                        ?? ($decodedProduct['en']['ProductName'] ?? 'Unnamed Product');

                    Log::info("✅ Decoded Product", [
                        'ProductID'   => $product->ProductID,
                        'Final Name'  => $product->LocalizedProductName
                    ]);

                    return $product;
                });

                return $category;
            });

            Log::info("✅ Final Category Data", ['categories' => $categories->toArray()]);

            // Share with views
            View::share('categories', $categories);
        });
    }

    public function register()
    {
        // No additional registration is required.
    }
}
