<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductComponent;
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

        // ✅ Ensure Components 12 and 13 are hidden by default
        $showComponent12And13 = false;

        // Process and prepare components for display
        foreach ($product->components as $component) {
            $component->allowsCustom = in_array($component->ComponentID, ['1', '5', '8']);
            
            $componentNameDecoded = $this->decodeJson($component->ComponentName);
            $component->ComponentName = $componentNameDecoded[$locale]['ComponentName'] 
                ?? $componentNameDecoded['en']['ComponentName'] 
                ?? 'Unnamed Component';

            // ✅ Check for component value ID 29 (Variant 3)
            foreach ($component->componentValues as $values) {
                $componentValueDecoded = $this->decodeJson($values->ComponentValueName);
                $values->ComponentValueName = $componentValueDecoded[$locale]['ComponentValueName'] 
                    ?? $componentValueDecoded['en']['ComponentValueName'] 
                    ?? 'Unnamed Value';

                if ($values->ComponentValueID == 29) {
                    $showComponent12And13 = false;  // Prevent pre-selection issue
                }
            }

            $component->ComponentMultimediaPath = $this->decodeJson($component->ComponentMultimediaPath);
            $component->localizedMultimedia = $component->ComponentMultimediaPath[$locale] 
                ?? $component->ComponentMultimediaPath['en'] 
                ?? [];
        }

        // ✅ Fetch components 12 and 13 separately (not merged initially)
        $additionalComponents = Component::whereIn('ComponentID', [12, 13])
            ->with('componentValues')
            ->get();

        foreach ($additionalComponents as $additionalComponent) {
            $componentNameDecoded = $this->decodeJson($additionalComponent->ComponentName);
            $additionalComponent->ComponentName = $componentNameDecoded[$locale]['ComponentName'] 
                ?? $componentNameDecoded['en']['ComponentName'] 
                ?? 'Unnamed Component';

            foreach ($additionalComponent->componentValues as $value) {
                $valueDecoded = $this->decodeJson($value->ComponentValueName);
                $value->ComponentValueName = $valueDecoded[$locale]['ComponentValueName'] 
                    ?? $valueDecoded['en']['ComponentValueName'] 
                    ?? 'Unnamed Value';
            }
        }

        // ✅ Decode and localize product descriptions
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

        // ✅ Return the view with properly controlled components visibility
        return view('Frontend.show', compact('product', 'additionalComponents', 'showComponent12And13'));
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
    // Form Submission - Handle form submission and calculate the total price
    public function submit(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $totalPrice = $product->ProductPrice;
        $selectedComponents = [];
        $locale = app()->getLocale();
    
        $showAdditionalComponents = false;
    
        foreach ($request->input('components', []) as $componentId => $values) {
            $component = $product->components->find($componentId);
            if (!$component) continue;
    
            if (is_array($values)) {
                foreach ($values as $value) {
                    $this->addComponentValue($component, $value, $selectedComponents, $request, $totalPrice);
    
                    // ✅ If Component Value ID 29 is selected, set the flag to show Components 12 and 13
                    if ($value == 29) {
                        $showAdditionalComponents = true;
                    }
                }
            } else {
                $this->addComponentValue($component, $values, $selectedComponents, $request, $totalPrice);
    
                // ✅ If Component Value ID 29 is selected, set the flag to show Components 12 and 13
                if ($values == 29) {
                    $showAdditionalComponents = true;
                }
            }
    
            // ✅ Special Handling for Object Area (Component ID 1 and Value >= 12mm)
            if ($componentId == 1 && $request->has("object_area.$componentId")) {
                $objectAreaValue = $request->input("object_area.$componentId");
                if ($objectAreaValue) {
                    $decodedName = json_decode($component->ComponentName, true);
                    $componentName = $decodedName[$locale]['ComponentName'] ?? 'Object Area';
    
                    $selectedComponents[] = [
                        'component_id' => $component->ComponentID,
                        'name' => "$componentName",
                        'value' => "Object Area: " . (string)$objectAreaValue,
                        'price' => 0
                    ];
                }
            }
        }
    
        // ✅ Add Components 12 and 13 if Component Value ID 29 is selected
        if ($showAdditionalComponents) {
            $additionalComponents = Component::whereIn('ComponentID', [12, 13])
                ->with('componentValues')
                ->get();
    
            foreach ($additionalComponents as $additionalComponent) {
                // ✅ Decode the ComponentName
                $decodedComponentName = json_decode($additionalComponent->ComponentName, true);
                $additionalComponent->ComponentName = $decodedComponentName[$locale]['ComponentName']
                    ?? $decodedComponentName['en']['ComponentName']
                    ?? $additionalComponent->ComponentName;
    
                $additionalValues = $request->input("components.{$additionalComponent->ComponentID}", []);
                if (is_array($additionalValues)) {
                    foreach ($additionalValues as $additionalValue) {
                        $this->addComponentValue($additionalComponent, $additionalValue, $selectedComponents, $request, $totalPrice);
                    }
                } else {
                    $this->addComponentValue($additionalComponent, $additionalValues, $selectedComponents, $request, $totalPrice);
                }
            }
        }
    
        // ✅ Special Handling for Custom Power Plug Input
        $powerPlugInput = $request->input('powerPlugInput');
        if (is_array($powerPlugInput)) {
            $powerPlugInput = implode(', ', array_map('strval', $powerPlugInput));
        }
    
        if ($powerPlugInput) {
            $powerPlugComponent = $product->components->where('ComponentID', '4')->first();
            $decodedName = $powerPlugComponent ? json_decode($powerPlugComponent->ComponentName, true) : [];
            $componentName = $decodedName[$locale]['ComponentName'] ?? 'Power Plug';
    
            $selectedComponents[] = [
                'component_id' => $powerPlugComponent ? $powerPlugComponent->ComponentID : null,
                'name' => $componentName,
                'value' => (string)$powerPlugInput,
                'price' => 0
            ];
        }
    
        // ✅ Save the Basket
        $uniqueIdentifier = md5($id . serialize($selectedComponents));
        $basket = session()->get('basket', []);
        $basket[] = [
            'product_id' => $id,
            'product_name' => $product->ProductName,
            'base_price' => $product->ProductPrice,
            'total_price' => $totalPrice,
            'components' => $selectedComponents,
            'quantity' => 1,
            'unique_identifier' => $uniqueIdentifier
        ];
        session()->put('basket', $basket);
        Log::info('Final Stored Basket (Debugging):', $basket);
    
        return redirect()->route('basket.show')->with('success', 'Product added to basket successfully!');
    }
    
    // ✅ Updated addComponentValue Method with JSON Decoding and Components 12/13 Handling
    private function addComponentValue($component, $value, &$selectedComponents, $request, &$totalPrice)
    {
        $locale = app()->getLocale();
    
        // ✅ Handle Custom Inputs Separately
        if ($value === 'Other') {
            $customValue = $request->input("custom_components.{$component->ComponentID}");
            if ($customValue) {
                $decodedComponentName = json_decode($component->ComponentName, true);
                $componentName = $decodedComponentName[$locale]['ComponentName']
                    ?? $decodedComponentName['en']['ComponentName']
                    ?? 'Unnamed Component';
    
                $selectedComponents[] = [
                    'component_id' => $component->ComponentID,
                    'name' => $componentName,
                    'value' => (string)$customValue,
                    'price' => 0
                ];
            }
        } else {
            // ✅ Standard Components - Proper JSON Decoding Handled
            $componentValue = $component->componentValues->find($value);
            if ($componentValue) {
                $decodedValue = json_decode($componentValue->ComponentValueName, true);
                $valueString = $decodedValue[$locale]['ComponentValueName']
                    ?? $decodedValue['en']['ComponentValueName']
                    ?? $componentValue->ComponentValueName;
                $price = $componentValue->ComponentValuePrice ?? 0;
    
                // ✅ Decode ComponentName
                $decodedComponentName = json_decode($component->ComponentName, true);
                $componentName = $decodedComponentName[$locale]['ComponentName']
                    ?? $decodedComponentName['en']['ComponentName']
                    ?? $component->ComponentName;
    
                $selectedComponents[] = [
                    'component_id' => $component->ComponentID,
                    'name' => $componentName,
                    'value' => $valueString,
                    'price' => $price
                ];
                $totalPrice += $price;
            }
        }
    }
    
    

}
