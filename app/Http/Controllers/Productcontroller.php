<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ComponentValue;
use App\Models\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class Productcontroller extends Controller
{
    // Homepage - Display all products
    public function index()
    {
        // Log the current application locale
        $locale = App::getLocale(); // This should reflect the correct locale
        Log::info('ProductController: Current application locale is ' . $locale);

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
                                    $product->ProductDescription['en'] ?? '';

            return $product;
        });

        // Pass the products to the view
        return view('Frontend.about', compact('products'));
    }

    // Product Page - Display the selected product and its components
    public function show($id)
    {
        // Retrieve the product by `ProductID`, loading `components` and their `values` if they exist
        $product = Product::with(['components.values'])->where('ProductID', $id)->first();

        // Check if product was found
        if (!$product) {
            abort(404); // Or you can return a specific error view
        }

        // Decode ProductMiniDescription if it's a JSON string
        if (is_string($product->ProductMiniDescription)) {
            $product->ProductMiniDescription = json_decode($product->ProductMiniDescription, true);
        }

        // Decode ProductDescription if it's a JSON string
        if (is_string($product->ProductDescription)) {
            $product->ProductDescription = json_decode($product->ProductDescription, true);
        }

        // Decode ProductMultimediaPath
        if (is_string($product->ProductMultimediaPath)) {
            $product->ProductMultimediaPath = json_decode($product->ProductMultimediaPath, true);
        }

        // Define locale if it's not set, default to 'en'
        $locale = app()->getLocale(); // Assuming locale is determined from app settings

        // Get the correct language data or fallback to 'en'
        $product->minidescription = $product->ProductMiniDescription[$locale]['ProductMiniDescription'] ?? 
                                    $product->ProductMiniDescription['en']['ProductMiniDescription'] ?? '';

        $product->description = $product->ProductDescription[$locale] ?? 
                                $product->ProductDescription['en'] ?? '';

        // Extract multimedia
        $product->multimedia = $product->ProductMultimediaPath[$locale] ?? 
                                $product->ProductMultimediaPath['en'] ?? [];

        // Pass the product to the view
        return view('Frontend.show', compact('product'));
    }

    // Form Submission - Handle form submission and calculate total price
    public function submit(Request $request, $id)
    {
        // Retrieve the product by its ID
        $product = Product::findOrFail($id);
    
        // Retrieve the selected components (assuming they're sent as an array)
        $selectedComponents = $request->input('components', []);  // An array of selected component IDs
    
        // Initialize total price with the base product price
        $totalPrice = $product->ProductPrice;
    
        // Initialize an array to store selected components
        $selectedItems = [];
    
        // Loop through the selected component IDs
        foreach ($selectedComponents as $componentId => $valueIds) {
            // Find the component by ID
            $component = Component::find($componentId);
    
            if ($component) {
                // If the component has multiple values selected (e.g., checkboxes), we loop through the values
                if (is_array($valueIds)) {
                    foreach ($valueIds as $valueId) {
                        $componentValue = ComponentValue::find($valueId);
    
                        if ($componentValue) {
                            // Add the price of the selected component value to the total
                            $totalPrice += $componentValue->ComponentValuePrice;
                            $selectedItems[] = [
                                'component_name' => $component->ComponentName,
                                'value_name' => $componentValue->ComponentValueName,
                                'value_price' => $componentValue->ComponentValuePrice,
                            ];
                        }
                    }
                } else {
                    // For single selected values (e.g., radio buttons), handle it as a single selection
                    $componentValue = ComponentValue::find($valueIds);
    
                    if ($componentValue) {
                        // Add the price of the selected component value to the total
                        $totalPrice += $componentValue->ComponentValuePrice;
                        $selectedItems[] = [
                            'component_name' => $component->ComponentName,
                            'value_name' => $componentValue->ComponentValueName,
                            'value_price' => $componentValue->ComponentValuePrice,
                        ];
                    }
                }
                  
              
                // Check for custom "Other" field for 4K Minicam Lens (componentId = 1)
                if ($component->ComponentName == '4K Minicam Lens' && $request->has("components[{$componentId}][lens_otherField]")) {
                    $lensOtherField = $request->input("components[{$componentId}][lens_otherField]");
                    if ($lensOtherField) {
                        // Assuming the custom lens price is handled here or you can set a default price
                        $lensPrice = 0; // Default price for custom lens input, or calculate based on input
                        $totalPrice += $lensPrice;
                        $selectedItems[] = [
                            'component_name' => $component->ComponentName,
                            'value_name' => $lensOtherField,
                            'value_price' => $lensPrice,
                        ];
                    }
                }
    
                // Check for custom "Other" field for Geographic Area for Power (componentId = 5)
                if ($component->ComponentName == 'Geographic area for power' && $request->has("components[{$componentId}][geo_otherField]")) {
                    $geoOtherField = $request->input("components[{$componentId}][geo_otherField]");
                    if ($geoOtherField) {
                        // Assuming the custom geographic area price is handled here or you can set a default price
                        $geoPrice = 0; // Default price for custom geo input, or calculate based on input
                        $totalPrice += $geoPrice;
                        $selectedItems[] = [
                            'component_name' => $component->ComponentName,
                            'value_name' => $geoOtherField,
                            'value_price' => $geoPrice,
                        ];
                    }
                }
            }
        }
    
        // Get the existing basket data from the session
        $basket = session()->get('basket', []);
    
        // Add the new product to the basket with selected components
        $basket[] = [
            'product_id' => $product->id,  // Make sure to include the product ID for identification
            'product_name' => $product->ProductName,
            'product_price' => $product->ProductPrice,
            'currency' => $product->ProductCurrency,
            'components' => $selectedItems,
            'total_price' => $totalPrice,
        ];
    
        // Store the updated basket in the session
        session(['basket' => $basket]);
    
        // Redirect to the basket page
        return redirect()->route('basket.show');
    }
    
}
