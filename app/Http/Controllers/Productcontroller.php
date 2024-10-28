<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\ComponentValue;
use Illuminate\Support\Facades\Log; // Import the Log facade
use Illuminate\Support\Facades\App; 


use Illuminate\Http\Request;

class Productcontroller extends Controller
{
    // Homepage - Display all products
    public function index()
{
    // Log the current application locale
    $locale = App::getLocale(); // This should reflect the correct locale
    Log::info('ProductController: Current application locale is ' . $locale);
    // Get the locale from session or default to 'en'
    $locale = session('locale', 'en');

    // Get all products
    $products = Product::all()->map(function ($product) use ($locale) {
        // Decode ProductMiniDescription if it's a JSON string
        if (is_string($product->ProductMiniDescription)) {
            $product->ProductMiniDescription = json_decode($product->ProductMiniDescription, true);
        }

        // Decode ProductDescription if it's a JSON string
        if (is_string($product->ProductDescription)) {
            $product->ProductDescription = json_decode($product->ProductDescription, true);
        }

        // Get the correct language data or fallback to 'en'
        $product->minidescription = $product->ProductMiniDescription[$locale]['ProductMiniDescription'] ?? 
                                    $product->ProductMiniDescription['en']['ProductMiniDescription'] ?? '';

        $product->description = $product->ProductDescription[$locale] ?? 
                                $product->ProductDescription['en'] ?? [];

        return $product;
    });
    $locale = App::getLocale(); // Check the currently set locale
    Log::info('ProductController: Current application locale is ' . $locale);

    // Pass the products to the view
    return view('Frontend.about', compact('products'));
}

    

    // Product Page - Display the selected product and its components
    public function show($id)
    {
        // Retrieve the product by `ProductID`, loading `components` only if they exist
    $product = Product::with(['components.values'])->where('ProductID', $id)->firstOrFail();

    // Pass the product to the view
    return view('Frontend.show', compact('product'));
    }
    

    // Form Submission - Handle form submission and calculate total price
    public function submit(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $selectedComponents = $request->components;

        // Calculate total price
        $totalPrice = $product->price;
        foreach ($selectedComponents as $componentId => $valueId) {
            $componentValue = ComponentValue::find($valueId);
            if ($componentValue) {
                $totalPrice += $componentValue->additional_price;
            }
        }

        // Return confirmation view with the total price
        return view('products.confirmation', compact('product', 'totalPrice'));
    }
}