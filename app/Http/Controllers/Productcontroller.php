<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ComponentValue;
use App\Models\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;

class ProductController extends Controller
{
    // Homepage - Display all products
    public function index()
    {
        $locale = App::getLocale();
        Log::info('ProductController: Current application locale is ' . $locale);

        $products = Product::all()->map(function ($product) use ($locale) {
            $product->ProductMiniDescription = $this->decodeJson($product->ProductMiniDescription);
            $product->ProductDescription = $this->decodeJson($product->ProductDescription);

            $product->minidescription = $product->ProductMiniDescription[$locale]['ProductMiniDescription'] 
                ?? $product->ProductMiniDescription['en']['ProductMiniDescription'] 
                ?? '';
            $product->description = $product->ProductDescription[$locale] 
                ?? $product->ProductDescription['en'] 
                ?? '';

            return $product;
        });

        return view('Frontend.about', compact('products'));
    }

    // Product Page - Display the selected product and its components
    public function show($id)
    {
        $product = Product::with(['components.componentValues'])->findOrFail($id);
        $locale = app()->getLocale();
    
        foreach ($product->components as $component) {
            // Set allowsCustom dynamically
            $component->allowsCustom = in_array($component->ComponentID, ['1', '5', '8']);
    
            // Decode and localize ComponentName
            $componentNameDecoded = $this->decodeJson($component->ComponentName);
            $component->ComponentName = $componentNameDecoded[$locale]['ComponentName'] 
                ?? $componentNameDecoded['en']['ComponentName'] 
                ?? 'Unnamed Component';
    
            // ✅ Decode and localize each ComponentValueName (More Robust Handling)
            foreach ($component->componentValues as $values) {
                // Decode the JSON data
                $componentValueDecoded = $this->decodeJson($values->ComponentValueName);
            
                // Log the raw decoded data for inspection
                Log::info('Decoded ComponentValueName:', ['componentValueDecoded' => $componentValueDecoded]);
            
                // Explicitly setting the value as a string
                $values->ComponentValueName = 'Unnamed Value';  
            
                // Assign only the plain string value, not the entire array
                if (isset($componentValueDecoded[$locale]['ComponentValueName'])) {
                    $values->ComponentValueName = (string) $componentValueDecoded[$locale]['ComponentValueName'];
                } elseif (isset($componentValueDecoded['en']['ComponentValueName'])) {
                    $values->ComponentValueName = (string) $componentValueDecoded['en']['ComponentValueName'];
                }
            
                // Fix the logging issue by directly logging a string
                Log::info('Final ComponentValueName Set: ' . $values->ComponentValueName);
            }
            
            
            
            
            
    
            // Decode ComponentMultimediaPath safely
            $component->ComponentMultimediaPath = $this->decodeJson($component->ComponentMultimediaPath);
            $component->localizedMultimedia = $component->ComponentMultimediaPath[$locale] ?? $component->ComponentMultimediaPath['en'] ?? [];
        }
    
        // Decode and localize product fields safely
        $product->ProductMiniDescription = $this->decodeJson($product->ProductMiniDescription);
        $product->ProductDescription = $this->decodeJson($product->ProductDescription);
        $product->ProductMultimediaPath = $this->decodeJson($product->ProductMultimediaPath);
    
        $product->minidescription = $product->ProductMiniDescription[$locale]['ProductMiniDescription'] 
            ?? $product->ProductMiniDescription['en']['ProductMiniDescription'] 
            ?? 'No mini description available';
        $product->description = $product->ProductDescription[$locale] 
            ?? $product->ProductDescription['en'] 
            ?? 'No description available';
        $product->multimedia = $product->ProductMultimediaPath[$locale] 
            ?? $product->ProductMultimediaPath['en'] 
            ?? [];
    
        return view('Frontend.show', compact('product'));
    }
    
    /**
     * Decode a JSON string safely and avoid redundant decoding.
     *
     * @param mixed $jsonString
     * @return array
     */
    private function decodeJson($jsonString)
    {
        if (is_array($jsonString)) {
            return $jsonString;
        }
    
        // Try decoding once
        if (is_string($jsonString)) {
            $decoded = json_decode($jsonString, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return $decoded;
            }
        }
    
        // Try decoding double-encoded strings
        $doubleDecoded = json_decode(stripslashes($jsonString), true);
        if (json_last_error() === JSON_ERROR_NONE) {
            return $doubleDecoded;
        }
    
        // Return an empty array if decoding fails
        return [];
    }
    

    // Form Submission - Handle form submission and calculate the total price
    public function submit(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $totalPrice = $product->ProductPrice;
        $selectedComponents = [];
    
        foreach ($request->input('components', []) as $componentId => $values) {
            $component = $product->components->find($componentId);
            if (!$component) continue;
    
            if (is_array($values)) {
                foreach ($values as $value) {
                    $this->addComponentValue($component, $value, $selectedComponents, $request, $totalPrice);
                }
            } else {
                $this->addComponentValue($component, $values, $selectedComponents, $request, $totalPrice);
            }
        }
    // Special handling for custom "Power Plug" input
$powerPlugInput = $request->input('powerPlugInput');

// ✅ Convert array to a string if necessary
if (is_array($powerPlugInput)) {
    $powerPlugInput = implode(', ', array_map('strval', $powerPlugInput));
}

if ($powerPlugInput) {
    // ✅ Dynamically resolve the localized name for the "Power Plug" component
    $powerPlugComponent = $product->components->where('ComponentID', '4')->first();

    if ($powerPlugComponent) {
        $decodedName = $this->decodeJson($powerPlugComponent->ComponentName);
        $locale = app()->getLocale();
        $componentName = $decodedName[$locale]['ComponentName'] 
                        ?? $decodedName['en']['ComponentName'] 
                        ?? 'Power Plug';
    } else {
        $componentName = 'Power Plug';  // Fallback if the component is missing
    }

    // ✅ Store the dynamically resolved component name
    $selectedComponents[] = [
        'component_id' => $powerPlugComponent ? $powerPlugComponent->ComponentID : null,  // Handle missing component ID
        'name' => $componentName, 
        'value' => (string) $powerPlugInput,
        'price' => 0
    ];
}



    
        // Generate a unique identifier for the product
        $uniqueIdentifier = md5($id . serialize($selectedComponents));
    
        $basket = session()->get('basket', []);
        $found = false;
    
        foreach ($basket as &$item) {
            if ($item['unique_identifier'] === $uniqueIdentifier) {
                $item['quantity'] += 1;
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
        Log::info('Final Stored Basket (Debugging):', $basket);
    
        return redirect()->route('basket.show')->with('success', 'Product added to basket successfully!');
    }
    
    // ✅ FIX: Ensure component values are stored as strings, not arrays
    private function addComponentValue($component, $value, &$selectedComponents, $request, &$totalPrice)
    {
        $locale = app()->getLocale();
    
        // ✅ Handle Custom Inputs Separately
        if ($value === 'Other') {
            $customValue = $request->input("custom_components.{$component->ComponentID}");
            if ($customValue) {
                $decodedComponentName = $this->decodeJson($component->ComponentName);
                $componentName = $decodedComponentName[$locale]['ComponentName'] 
                                ?? $decodedComponentName['en']['ComponentName'] 
                                ?? 'Unnamed Component';
    
                $selectedComponents[] = [
                    'component_id' =>$component->ComponentID,  // Custom inputs don't have IDs
                    'name' =>$component->ComponentName,
                    'value' => (string) $customValue,  
                    'price' => 0
                ];
            }
        } else {
            // ✅ Standard Components - Store IDs and Resolve Locale Later
            $componentValue = $component->componentValues->find($value);
            if ($componentValue) {
                $selectedComponents[] = [
                    'component_id' => $component->ComponentID,  
                    'value_id' => $componentValue->ComponentValueID,  
                    'price' => $componentValue->ComponentValuePrice ?? 0
                ];
                $totalPrice += $componentValue->ComponentValuePrice ?? 0;
            }
        }
    }
    
    

}
