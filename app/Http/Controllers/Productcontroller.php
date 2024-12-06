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
                    // Store the decoded data
                    $component->ComponentMultimediaPath = $decodedMultimedia;
                }
            }
    
            // Set localized values for multimedia
            $locale = app()->getLocale();
            if (isset($component->ComponentMultimediaPath[$locale])) {
                $component->localizedMultimedia = $component->ComponentMultimediaPath[$locale];
            } else {
                // Fallback to 'en' if the specific locale is not available
                $component->localizedMultimedia = $component->ComponentMultimediaPath['en'] ?? [];
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
    
        // Return the view with product data
        return view('Frontend.show', compact('product'));
    }
    
    // Inject BasketService
    protected $basketService;

    public function __construct(BasketService $basketService)
    {
        $this->basketService = $basketService;
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


    // Create a default entry for components with no user selection
    public function createDefaultComponentEntry($component)
{
    // Enable foreign key constraints for SQLite if needed
    DB::statement('PRAGMA foreign_keys = ON;');
    
    // Attempt to get the default value for the component
    $defaultValue = $component->componentValues->firstWhere('ComponentValueName', 'Default Value');
    
    // If no default value is found, log the issue and return a fallback entry
    if (!$defaultValue) {
        Log::error('No default value found for component: ' . $component->ComponentName);
        
        return [
            'component_id' => $component->ComponentID,
            'component_name' => $component->ComponentName,
            'value_id' => null,  // No value ID when default value is not available
            'value_name' => 'Default Value',  // Use a fallback default name
            'value_price' => 0,  // Default price if no default value exists
        ];
    }
    
    // Return the default value if found
    return [
        'component_id' => $component->ComponentID,
        'component_name' => $component->ComponentName,
        'value_id' => $defaultValue->ComponentValueID,
        'value_name' => $defaultValue->ComponentValueName,
        'value_price' => $defaultValue->ComponentValuePrice,
    ];
}

    
    // Process a user-provided value or match it to a predefined value
    protected function processComponentValue($component, $value)
{
    // Check if the value is custom (e.g., "Other")
    if ($value === 'Other') {
        return [
            'component_id' => $component->ComponentID,
            'component_name' => $component->ComponentName,
            'value_id' => null,  // No ID for custom values
            'value_name' => $value,  // Custom value provided by the user
            'value_price' => 0,  // No price for custom values
            'is_custom' => true,  // Mark this as a custom value
        ];
    }

    // Look for a predefined value in the component's available values
    $componentValue = $component->componentValues->where('ComponentValueName', $value)->first();

    // If a predefined value is found, return it with the associated price
    if ($componentValue) {
        return [
            'component_id' => $component->ComponentID,
            'component_name' => $component->ComponentName,
            'value_id' => $componentValue->ComponentValueID,
            'value_name' => $componentValue->ComponentValueName,
            'value_price' => $componentValue->ComponentValuePrice,
            'is_custom' => false,  // Mark this as not a custom value
        ];
    }

    // If no predefined value is found, treat it as a custom value (user-provided)
    return [
        'component_id' => $component->ComponentID,
        'component_name' => $component->ComponentName,
        'value_id' => null,  // No ID for custom values
        'value_name' => $value,  // Custom value provided by the user
        'value_price' => 0,      // No price for custom values
        'is_custom' => true,     // Mark this as a custom value
    ];
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
    

    protected function createNewProductForCustomValue($component, $processedValue)
{
    // Custom products for components like "Other" that require additional pricing
    $newProductPrice = 0;

    // If the component value includes an additional price (e.g., +100 EUR)
    if (in_array($processedValue['value_name'], ['40m', '70m', '100m'])) {
        // Example of additional pricing logic based on the selected custom value
        switch ($processedValue['value_name']) {
            case '40m':
                $newProductPrice = 100; // +100 EUR for 40m fiber optics
                break;
            case '70m':
                $newProductPrice = 200; // +200 EUR for 70m fiber optics
                break;
            case '100m':
                $newProductPrice = 300; // +300 EUR for 100m fiber optics
                break;
        }
    }

    // Return a new product for this custom component value
    return [
        'component_id' => $component->ComponentID,
        'component_name' => $component->ComponentName,
        'value_id' => null,  // No predefined value ID
        'value_name' => $processedValue['value_name'],
        'value_price' => $newProductPrice,  // Additional cost for this custom selection
        'is_custom' => true,
    ];
}

    
}
