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
    foreach ($request->input('components', []) as $componentId => $values) {
        $component = $product->components->find($componentId);

        if (!$component) continue; // Skip if component not found

        if (is_array($values)) { // Handle multi-select components
            foreach ($values as $value) {
                $this->addComponentValue($component, $value, $selectedComponents, $request, $totalPrice);
            }
        } else { // Handle single-value components
            $this->addComponentValue($component, $values, $selectedComponents, $request, $totalPrice);
        }
    }

    // Special handling for custom "Power Plug" input
    $powerPlugInput = $request->input('powerPlugInput');
    if ($powerPlugInput) {
        $selectedComponents[] = [
            'name' => 'Power Plug',
            'value' => $powerPlugInput,
            'price' => 0
        ];
    }

    // Generate a unique identifier for the product
    $uniqueIdentifier = md5($id . serialize($selectedComponents));

    // Add product to the basket or update if it already exists
    $basket = session()->get('basket', []);
    $found = false;

    foreach ($basket as &$item) {
        if ($item['unique_identifier'] === $uniqueIdentifier) {
            $item['quantity'] += 1; // Update quantity
            $item['total_price'] += $totalPrice;
            $found = true;
            break;
        }
    }

    if (!$found) {
        $basket[] = [
            'product_id' => $id,
            'product_name' => $product->ProductName,
            'base_price' => $product->ProductPrice,
            'total_price' => $totalPrice,
            'components' => $selectedComponents,
            'quantity' => 1,
            'unique_identifier' => $uniqueIdentifier
        ];
    }

    session()->put('basket', $basket);

    Log::info('Basket Data:', session()->get('basket')); // Debugging log

    return redirect()->route('basket.show')->with('success', 'Product added to basket successfully!');
}

// Helper method to process component values, including custom "Other" option
private function addComponentValue($component, $value, &$selectedComponents, $request, &$totalPrice)
{
    if ($value === 'Other') {
        // Handle the custom "Other" input
        $customValue = $request->input("custom_components.{$component->ComponentID}");
        if ($customValue) {
            $selectedComponents[] = [
                'name' => $component->ComponentName,
                'value' => $customValue,
                'price' => 0
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
            $totalPrice += $componentValue->ComponentValuePrice ?? 0;
        }
    }
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
    

    public function submitOrder(Request $request)
{
    $basket = session()->get('basket', []);

    if (empty($basket)) {
        return redirect()->route('basket.show')->with('error', 'Your basket is empty.');
    }

    // Temporarily store basket in session for further processing
    session()->put('order_basket', $basket);

    return redirect()->route('order.customerForm');
}

public function showCustomerForm()
{
    $basket = session()->get('order_basket', []);

    if (empty($basket)) {
        return redirect()->route('basket.show')->with('error', 'No order data found. Please try again.');
    }

    return view('Frontend.customer_form', compact('basket'));
}

public function submitCustomerDetails(Request $request)
{
    $request->validate([
        'OrderCustName' => 'required|string|max:255',
        'OrderEmail' => 'required|email|max:255',
        'OrderPhone' => 'nullable|string|max:20',
        'OrderAddress' => 'required|string|max:255',
        'OrderComment' => 'nullable|string',
    ]);

    $basket = session()->get('order_basket', []);

    if (empty($basket)) {
        return redirect()->route('basket.show')->with('error', 'Order data is missing.');
    }

    try {
        DB::beginTransaction();

        // Insert into Order table
        $orderId = DB::table('Order')->insertGetId([
            'OrderCustName' => $request->input('OrderCustName'),
            'OrderEmail' => $request->input('OrderEmail'),
            'OrderPhone' => $request->input('OrderPhone'),
            'OrderAddress' => $request->input('OrderAddress'),
            'OrderComment' => $request->input('OrderComment'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert order items into OrderItem table
        foreach ($basket as $item) {
            foreach ($item['components'] as $component) {
                DB::table('OrderItem')->insert([
                    'OrderID' => $orderId,
                    'ProductID' => $item['product_id'],
                    'ComponentID' => $component['name'],
                    'ComponentValueName' => is_array($component['value']) ? implode(', ', $component['value']) : $component['value'],
                    'OrderItemQuantity' => $item['quantity'],
                    'OrderItemPrice' => $component['price'],
                    'OrderItemCurrency' => 'EUR',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        DB::commit();

        // Clear the session
        session()->forget(['order_basket', 'basket']);

        return redirect()->route('basket.show')->with('success', 'Order placed successfully!');
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Order Submission Failed: ' . $e->getMessage());
        return redirect()->route('basket.show')->with('error', 'Failed to place the order.');
    }
}


    
}
