<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ComponentValue;
use App\Models\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use App\Services\BasketService;
use Illuminate\Support\Facades\DB;

class Productcontroller extends Controller
{
    // Homepage - Display all products
    public function index()
    {
        $locale = App::getLocale();
        Log::info('ProductController: Current application locale is ' . $locale);

        $products = Product::all()->map(function ($product) use ($locale) {
            if (is_string($product->ProductMiniDescription)) {
                $product->ProductMiniDescription = json_decode($product->ProductMiniDescription, true);
            }

            if (is_string($product->ProductDescription)) {
                $product->ProductDescription = json_decode($product->ProductDescription, true);
            }

            $product->minidescription = $product->ProductMiniDescription[$locale]['ProductMiniDescription'] ?? $product->ProductMiniDescription['en']['ProductMiniDescription'] ?? '';
            $product->description = $product->ProductDescription[$locale] ?? $product->ProductDescription['en'] ?? '';

            return $product;
        });

        return view('Frontend.about', compact('products'));
    }

    // Product Page - Display the selected product and its components
    public function show($id)
    {
        // Retrieve product with related components and their values
        $product = Product::with(['components.componentValues'])->findOrFail($id);
    
        // Loop through each component to set allowsCustom and decode multimedia
        foreach ($product->components as $component) {
            //print($component);
            //print("<br>");
            // dd();
            // Add allowsCustom field dynamically
            if (in_array($component->ComponentName, ['4K Minicam Lens', 'Geographic area for power', 'Color Temperature'])) {
                $component->allowsCustom = true;
            } else {
                $component->allowsCustom = false;
            }
    
            // Decode ComponentMultimediaPath if it's a string
            if (is_string($component->ComponentMultimediaPath)) {
                $decodedMultimedia = json_decode($component->ComponentMultimediaPath, true);
    
                if (json_last_error() === JSON_ERROR_NONE) {
                    $component->ComponentMultimediaPath = $decodedMultimedia;
                } else {
                    $component->ComponentMultimediaPath = []; // Default to empty array if JSON decode fails
                }
            }
    
            // Set localized multimedia based on locale
            $locale = app()->getLocale();
            // Check if multimedia exists for the given locale
            if (isset($component->ComponentMultimediaPath[$locale])) {
                $component->localizedMultimedia = $component->ComponentMultimediaPath[$locale];
            } else {
                // Fallback to default language (e.g., 'en')
                $component->localizedMultimedia = $component->ComponentMultimediaPath['en'] ?? [];
            }
    
            // Debugging output to ensure that localized multimedia is being set
            if (empty($component->localizedMultimedia)) {
                Log::info("No localized multimedia for component: " . $component->ComponentName);
            }
        }
    
        // Decode and handle product fields (MiniDescription, Description, MultimediaPath) for locale
        $locale = app()->getLocale();
        if (is_string($product->ProductMiniDescription)) {
            $product->ProductMiniDescription = json_decode($product->ProductMiniDescription, true);
        }
        if (is_string($product->ProductDescription)) {
            $product->ProductDescription = json_decode($product->ProductDescription, true);
        }
        if (is_string($product->ProductMultimediaPath)) {
            $product->ProductMultimediaPath = json_decode($product->ProductMultimediaPath, true);
        }
    
        // Set localized values for product fields
        $product->minidescription = $product->ProductMiniDescription[$locale]['ProductMiniDescription'] ?? $product->ProductMiniDescription['en']['ProductMiniDescription'] ?? '';
        $product->description = $product->ProductDescription[$locale] ?? $product->ProductDescription['en'] ?? '';
        $product->multimedia = $product->ProductMultimediaPath[$locale] ?? $product->ProductMultimediaPath['en'] ?? [];
    
        // Debugging output to check the final multimedia path
        if (empty($product->multimedia)) {
            Log::info("No product multimedia available for product ID: " . $product->id);
        }
    
        // Return the view with product data
        return view('Frontend.show', compact('product'));
    }
    
    
    

    // Form Submission - Handle form submission and calculate the total price
    public function submit(Request $request, $id)
{
    // Find the product by ID
    $product = Product::findOrFail($id);
    $totalPrice = $product->ProductPrice;
    $selectedComponents = [];

    // Process components selected in the form
    foreach ($request->input('components', []) as $componentId => $value) {
        $component = $product->components->find($componentId);

        if (!$component) continue; // Skip if component not found

        // Check if this component has a custom "Other" field or is a custom input like "Power Plug"
        if ($value === 'Other') {
            $customValue = $request->input("custom_components.{$componentId}");

            if ($customValue) {
                $selectedComponents[] = [
                    'name' => $component->ComponentName,
                    'value' => $customValue,
                    'price' => 0 // No additional cost for "Other" option
                ];
            }
        } else {
            // Handle regular component values
            $componentValue = $component->values->find($value);
            if ($componentValue) {
                $selectedComponents[] = [
                    'name' => $component->ComponentName,
                    'value' => $componentValue->ComponentValueName,
                    'price' => $componentValue->ComponentValuePrice ?? 0
                ];

                // Add the price to the total (ensure it's numeric)
                $totalPrice += $componentValue->ComponentValuePrice ?? 0;
            }
        }
    }

    // Special handling for custom "Power Plug" input
    $powerPlugInput = $request->input('powerPlugInput');
    if ($powerPlugInput) {
        $selectedComponents[] = [
            'name' => 'Power Plug',
            'value' => $powerPlugInput,
            'price' => 0 // Assuming no additional cost for this custom value
        ];
    }

    // Add product with selected components to the session basket
    $basket = session()->get('basket', []);
    $basket[] = [
        'product_id' => $id,
        'product_name' => $product->ProductName,
        'base_price' => $product->ProductPrice,
        'total_price' => $totalPrice,
        'components' => $selectedComponents
    ];
    session()->put('basket', $basket);
    Log::info('Basket Data:', session()->get('basket'));

    // Optionally, add a success message
    return redirect()->route('basket.show')->with('success', 'Product added to basket successfully!');
}


   
    
    // Update the basket session with the selected product and components
    protected function updateBasket($basket, $product, $totalPrice, $selectedItems)
    {
        foreach ($basket as &$item) {
            if ($item['product_id'] === $product->ProductID) {
                // If the product is already in the basket, update its quantity and price
                $item['quantity'] += 1;
                $item['total_price'] += $totalPrice;
                $item['components'] = $selectedItems;
                return $basket;
            }
        }
    
        // If the product is not found in the basket, add a new entry
        $basket[] = [
            'product_id' => $product->ProductID,
            'product_name' => $product->ProductName,
            'product_price' => $product->ProductPrice,
            'currency' => $product->ProductCurrency,
            'components' => $selectedItems,
            'total_price' => $totalPrice,
            'quantity' => 1,
        ];
    
        return $basket;
    }
    


    
}
