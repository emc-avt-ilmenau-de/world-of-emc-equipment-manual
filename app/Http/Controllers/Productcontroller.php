<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ComponentValue;
use App\Models\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\SubmitProductFormRequest;
use App\Services\BasketService;

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
        $product = Product::with(['components.componentValues'])->findOrFail($id);

        if (!$product) {
            abort(404);
        }

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

        $product->minidescription = $product->ProductMiniDescription[$locale]['ProductMiniDescription'] ?? $product->ProductMiniDescription['en']['ProductMiniDescription'] ?? '';
        $product->description = $product->ProductDescription[$locale] ?? $product->ProductDescription['en'] ?? '';
        $product->multimedia = $product->ProductMultimediaPath[$locale] ?? $product->ProductMultimediaPath['en'] ?? [];

        return view('Frontend.show', compact('product'));
    }

    
        protected $basketService;
    
        // Inject BasketService
        public function __construct(BasketService $basketService)
        {
            $this->basketService = $basketService;
        }
    

    // Form Submission - Handle form submission and calculate the total price

    public function submit(Request $request, $id)
{
    $product = Product::with(['components.componentValues'])->findOrFail($id);
    
    Log::info('Form submission data:', $request->all());
    
    // Do not clear session entirely. Optionally clear basket session:
    // session()->forget('basket'); 
    
    $totalPrice = $product->ProductPrice;
    $selectedItems = [];
    $processedComponents = [];  // Initialize the array to track processed components

    // Process all components
    foreach ($product->components as $component) {
        $componentId = $component->ComponentID;

        // Prevent duplicate processing of components
        if (isset($processedComponents[$componentId])) {
            continue;
        }

        // Get user input for this component
        $values = $request->components[$componentId] ?? [];

        // If no value selected, log and create default entry
        if (!$values) {
            Log::warning('No value selected for component:', ['component' => $component->ComponentName]);
            $selectedItems[] = $this->createDefaultComponentEntry($component); // Add default entry
        } else {
            // Process selected values for components (multiple values allowed)
            foreach ($values as $key => $value) {
                $processedValue = $this->processComponentValue($component, $value);
                $selectedItems[] = $processedValue;
                $totalPrice += $processedValue['value_price']; // Update the total price
            }
        }

        $processedComponents[$componentId] = true;
    }

    Log::info('Selected items:', $selectedItems);

    // Update the basket with the selected components
    $basket = session('basket', []);
    $basket = $this->updateBasket($basket, $product, $totalPrice, $selectedItems);

    session(['basket' => $basket]);
    Log::info('Updated basket contents: ' . json_encode(session()->get('basket')));

    return redirect()->route('basket.show');
}

    

    // Create a default entry for components with no user selection
    protected function createDefaultComponentEntry($component)
    {
        return [
            'component_id' => $component->ComponentID,
            'component_name' => $component->ComponentName,
            'value_id' => null,
            'value_name' => 'Default Value',
            'value_price' => 0,
        ];
    }
    
    // Process a user-provided value or match it to a predefined value
    protected function processComponentValue($component, $value)
    {
        if (empty($value)) {
            $value = 'Default Value';
        }
    
        // Look for the matching component value
        $componentValue = $component->componentValues->where('ComponentValueName', $value)->first();
    
        // If a matching component value is found, return it with the price
        if ($componentValue) {
            // If price is NULL, set it to 0 by default
            $price = $componentValue->ComponentValuePrice ?? 0;
    
            return [
                'component_id' => $component->ComponentID,
                'component_name' => $component->ComponentName,
                'value_id' => $componentValue->ComponentValueID,
                'value_name' => $componentValue->ComponentValueName,
                'value_price' => $price,  // Use the price, or 0 if NULL
            ];
        }
    
        // If no predefined value is found, treat it as a custom input (still assign the value, but no price)
        return [
            'component_id' => $component->ComponentID,
            'component_name' => $component->ComponentName,
            'value_id' => null,
            'value_name' => $value,  // For custom input, the value is user-provided
            'value_price' => 0,      // No price for custom inputs
        ];
    }
    

    // Update the basket session with the selected product and components
    protected function updateBasket($basket, $product, $totalPrice, $selectedItems)
{
    foreach ($basket as &$item) {
        if ($item['product_id'] === $product->ProductID) {
            // Update the basket if the product already exists
            $item['quantity'] += 1;
            $item['total_price'] += $totalPrice;
            $item['components'] = $selectedItems;
            return $basket;
        }
    }

    // If the product is not found in the basket, add it
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
