<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductComponent;
use App\Models\ComponentValue;
use App\Models\Component;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Exception;

class ProductController extends Controller
{
    // Homepage - Display all products
    public function index(?Request $request = null)
    {
        $locale = app()->getLocale();
        Log::info('Current Locale: ' . $locale);

        // Fetch and decode categories
        $categories = Category::all()->map(function ($category) use ($locale) {
            $decoded = $this->decodeJson($category->CategoryName) ?? [];
            $category->CategoryName = $decoded[$locale]['CategoryName'] 
                ?? ($decoded['en']['CategoryName'] ?? 'Unnamed Category');
            return $category;
        });

        // Fetch products (Filter by category if selected)
        $productsQuery = Product::query();

        if ($request && $request->has('category')) {
            $selectedCategoryName = str_replace('-', ' ', strtolower($request->category));
            $selectedCategory = $categories->firstWhere('CategoryName', $selectedCategoryName);
            if ($selectedCategory) {
                $productsQuery->where('CategoryID', $selectedCategory->CategoryID);
            }
        }

        // Process products
        $products = $productsQuery->get()->map(function ($product) use ($locale) {
            $product->ProductName = $this->decodeJson($product->ProductName) ?? [];
            $product->ProductMiniDescription = $this->decodeJson($product->ProductMiniDescription) ?? [];
            $product->ProductDescription = $this->decodeJson($product->ProductDescription) ?? [];

            $product->ProductName = $product->ProductName[$locale]['ProductName'] 
                ?? ($product->ProductName['en']['ProductName'] ?? 'Unnamed Product');

            $product->minidescription = $product->ProductMiniDescription[$locale]['ProductMiniDescription'] 
                ?? ($product->ProductMiniDescription['en']['ProductMiniDescription'] ?? 'No description available');

            $product->description = $product->ProductDescription[$locale] 
                ?? ($product->ProductDescription['en'] ?? '');

            return $product;
        });

        return view('FrontEnd.index', compact('products', 'categories'));
    }

    // Product Page - Display the selected product and its components
    public function show($id)
    {
        $locale = app()->getLocale();

        // Fetch and decode categories
        $categories = Category::all()->map(function ($category) use ($locale) {
            $decoded = $this->decodeJson($category->CategoryName) ?? [];
            $category->CategoryName = $decoded[$locale]['CategoryName'] 
                ?? ($decoded['en']['CategoryName'] ?? 'Unnamed Category');
            return $category;
        });

        $product = Product::with(['components.componentValues'])->findOrFail($id);
        $locale = app()->getLocale();

        $showComponent12 = false;
        $showComponent14 = false;

        foreach ($product->components as $component) {
            $component->allowsCustom = in_array($component->ComponentID, ['1','4','5','8','13','19']);

            $componentNameDecoded = $this->decodeJson($component->ComponentName);
            $component->ComponentName = $this->getComponentName($componentNameDecoded, $locale);

            foreach ($component->componentValues as $values) {
                $rawDecoded = $this->decodeJsonOrRaw($values->ComponentValueName);
                if (is_array($rawDecoded)) {
                    $values->ComponentValueName = $this->getComponentValueName($rawDecoded, $locale);
                } else {
                    $values->ComponentValueName = trim($rawDecoded);
                }

                if ($values->ComponentValueID == 28) {
                    $showComponent12 = true;
                }
                if (in_array($values->ComponentValueID, [11, 12])) {
                    $showComponent14 = true;
                }
            }

            $component->ComponentMultimediaPath = $this->decodeJson($component->ComponentMultimediaPath);
            $component->localizedMultimedia = $component->ComponentMultimediaPath[$locale] 
                ?? $component->ComponentMultimediaPath['en'] 
                ?? [];
        }

        $additionalComponents = collect();
        if ($showComponent12) {
            $additionalComponents12 = Component::whereIn('ComponentID', [12, 15])->with('componentValues')->get();
            $additionalComponents = $additionalComponents->merge($additionalComponents12);
        }
        if ($showComponent14) {
            $additionalComponents14 = Component::where('ComponentID', 14)->with('componentValues')->get();
            $additionalComponents = $additionalComponents->merge($additionalComponents14);
        }

        foreach ($additionalComponents as $additionalComponent) {
            $additionalComponent->allowsCustom = in_array($additionalComponent->ComponentID, [12, 14]);
            $componentNameDecoded = $this->decodeJson($additionalComponent->ComponentName);
            $additionalComponent->ComponentName = $this->getComponentName($componentNameDecoded, $locale);

            foreach ($additionalComponent->componentValues as $value) {
                $rawDecoded = $this->decodeJsonOrRaw($value->ComponentValueName);
                if (is_array($rawDecoded)) {
                    $value->ComponentValueName = $this->getComponentValueName($rawDecoded, $locale);
                } else {
                    $value->ComponentValueName = trim($rawDecoded);
                }
            }
        }

        $product->ProductName = $this->decodeJson($product->ProductName) ?? [];
        $product->ProductMiniDescription = $this->decodeJson($product->ProductMiniDescription) ?? [];
        $product->ProductDescription = $this->decodeJson($product->ProductDescription) ?? [];
        $product->ProductMultimediaPath = $this->decodeJson($product->ProductMultimediaPath) ?? [];

        $product->ProductName = $product->ProductName[$locale]['ProductName'] 
            ?? ($product->ProductName['en']['ProductName'] ?? '');
        $product->minidescription = $product->ProductMiniDescription[$locale]['ProductMiniDescription'] 
            ?? ($product->ProductMiniDescription['en']['ProductMiniDescription'] ?? 'No mini description available');
        $product->description = $product->ProductDescription[$locale] 
            ?? ($product->ProductDescription['en'] ?? 'No description available');
        $product->multimedia = $product->ProductMultimediaPath[$locale] 
            ?? ($product->ProductMultimediaPath['en'] ?? []);

        Log::info('Final Additional Components:', $additionalComponents->toArray());

        return view('FrontEnd.show', compact('product', 'additionalComponents', 'showComponent12', 'showComponent14', 'categories'));
    }

    public function submit(Request $request, $id)
    {
        $product = Product::with('components.componentValues')->findOrFail($id);
        $totalPrice = $product->ProductPrice;
        $selectedComponents = [];
        $locale = app()->getLocale();
    
        $showAdditionalComponents = false;
        $showComponent14 = false;
    
        // Properly Localized Product Name
        $productNameDecoded = $this->decodeJson($product->ProductName);
        $product->ProductName = $productNameDecoded[$locale]['ProductName'] 
            ?? ($productNameDecoded['en']['ProductName'] ?? 'Unnamed Product');
    
        foreach ($request->input('components', []) as $componentId => $values) {
            $component = $product->components->firstWhere('ComponentID', $componentId);
            if (!$component) continue;
    
            // Decode component name safely
            $decodedComponentName = $this->decodeJson($component->ComponentName);
            $componentName = $decodedComponentName[$locale]['ComponentName'] 
                ?? $decodedComponentName['en']['ComponentName'] 
                ?? (is_array($decodedComponentName) && isset(reset($decodedComponentName)['ComponentName'])
                    ? reset($decodedComponentName)['ComponentName']
                    : 'Unknown Component');
            $component->ComponentName = is_string($componentName) ? trim($componentName) : 'Unknown Component';
            
            if (is_array($values)) {
                foreach ($values as $value) {
                    $this->addComponentValue($component, $value, $selectedComponents, $request, $totalPrice);
                    if ($value == 28) $showAdditionalComponents = true;
                    if (in_array($value, [11, 12])) $showComponent14 = true;
                }
            } else {
                $this->addComponentValue($component, $values, $selectedComponents, $request, $totalPrice);
                if ($values == 28) $showAdditionalComponents = true;
                if (in_array($values, [11, 12])) $showComponent14 = true;
            }
            // Special handling for object area (component ID 1)
            if ($componentId == 1 && $request->has("object_area.$componentId")) {
                $objectAreaValue = $request->input("object_area.$componentId");
                if (!empty($objectAreaValue)) {
                    if (is_array($objectAreaValue)) {
                        $objectAreaValue = implode(', ', array_filter(array_map('trim', $objectAreaValue)));
                    } else {
                        $objectAreaValue = trim((string)$objectAreaValue);
                    }
                    $foundIndex = null;
                    foreach ($selectedComponents as $index => $sc) {
                        if ($sc['component_id'] == $component->ComponentID) {
                            $foundIndex = $index;
                            break;
                        }
                    }
                    if ($foundIndex !== null) {
                        $selectedComponents[$foundIndex]['value'] .= ', ' . $objectAreaValue;
                    } else {
                        $selectedComponents[] = [
                            'component_id' => $component->ComponentID,
                            'name'         => "{$component->ComponentName} (Object Area)",
                            'value'        => $objectAreaValue,
                            'price'        => 0
                        ];
                    }
                }
            }
        }
    
        if ($showAdditionalComponents) {
            $this->addAdditionalComponents([12, 15], $request, $selectedComponents, $totalPrice, $locale);
        }
    
        if ($showComponent14) {
            $this->addAdditionalComponents([14], $request, $selectedComponents, $totalPrice, $locale);
        }

        /*
         |--------------------------------------------------------------------------------------
         | CHANGED #1: We store value_id in addComponentValue() if it exists (see below).
         | CHANGED #2: Our unique hash uses stable IDs and typed text only if no value_id.
         |--------------------------------------------------------------------------------------
        */
        $sortedComponents = collect($selectedComponents)
            ->sortBy('component_id')
            ->map(function ($component) {
                // Always include stable data: component_id and price
                // Then, if the user selected a known value_id, use that. 
                // If not, use typed text to differentiate.
                $hashItem = [
                    'component_id' => $component['component_id'],
                    'price'        => $component['price']
                ];
                if (!empty($component['value_id'])) {
                    $hashItem['value_id'] = $component['value_id'];
                } else {
                    $hashItem['plain_text'] = $component['value'];
                }
                return $hashItem;
            })
            ->values()
            ->all();

        $identifierCheck = md5($id . json_encode($sortedComponents, JSON_UNESCAPED_UNICODE));
    
        $basket = session()->get('basket', []);
    
        $found = false;
        foreach ($basket as &$item) {
            if ($item['unique_identifier'] === $identifierCheck) {
                $item['quantity'] += 1;
                $item['total_price'] += $totalPrice;
                $found = true;
                Log::info("Product Found in Cart - Increasing Quantity", ['identifier' => $identifierCheck]);
                break;
            }
        }
        if (!$found) {
            $basket[$identifierCheck] = [
                'product_id'       => $id,
                'product_name'     => $product->ProductName,
                'base_price'       => $product->ProductPrice,
                'total_price'      => $totalPrice,
                'components'       => $selectedComponents,
                'quantity'         => 1,
                'unique_identifier'=> $identifierCheck
            ];
            Log::info("New Product Added to Cart", ['identifier' => $identifierCheck]);
        }
    
        session()->put('basket', $basket);
        Log::info('Final Stored Basket:', ['basket' => session()->get('basket')]);
    
        return redirect()->route('basket.show')->with('success', 'Product added to basket successfully!');
    }
    
    private function addComponentValue($component, $value, &$selectedComponents, $request, &$totalPrice)
    {
        $locale = app()->getLocale();

        if ($value === 'Other') {
            $customValue = $request->input("custom_components.{$component->ComponentID}");
            if ($customValue) {
                $decodedComponentName = $this->decodeJson($component->ComponentName);
                $componentName = $decodedComponentName[$locale]['ComponentName']
                    ?? $decodedComponentName['en']['ComponentName']
                    ?? (is_array($decodedComponentName) && isset(reset($decodedComponentName)['ComponentName'])
                        ? reset($decodedComponentName)['ComponentName'] 
                        : $component->ComponentName);

                // CHANGED #1: No value_id for typed input
                $selectedComponents[] = [
                    'component_id' => $component->ComponentID,
                    'name'         => $componentName,
                    'value'        => (string)$customValue,
                    'price'        => 0
                    // 'value_id' => null
                ];
            }
        } else {
            $componentValue = $component->componentValues->firstWhere('ComponentValueID', $value);
            if ($componentValue) {
                $decodedValue = $this->decodeJsonOrRaw($componentValue->ComponentValueName);
                $valueString = is_array($decodedValue)
                    ? ($decodedValue[$locale]['ComponentValueName'] 
                        ?? $decodedValue['en']['ComponentValueName'] 
                        ?? $componentValue->ComponentValueName)
                    : trim($decodedValue);
    
                $price = $componentValue->ComponentValuePrice ?? 0;
    
                $decodedComponentName = $this->decodeJson($component->ComponentName);
                $componentName = $decodedComponentName[$locale]['ComponentName']
                    ?? $decodedComponentName['en']['ComponentName']
                    ?? $component->ComponentName;

                // CHANGED #1: We store value_id for stable hashing
                $selectedComponents[] = [
                    'component_id' => $component->ComponentID,
                    'name'         => $componentName,
                    'value'        => $valueString,
                    'value_id'     => $componentValue->ComponentValueID,  // <--- new line
                    'price'        => $price
                ];
                $totalPrice += $price;
            }
        }
    }

    private function addAdditionalComponents($componentIDs, $request, &$selectedComponents, &$totalPrice, $locale)
    {
        $additionalComponents = Component::whereIn('ComponentID', $componentIDs)
            ->with('componentValues')
            ->get();
    
        foreach ($additionalComponents as $component) {
            $decodedComponentName = $this->decodeJson($component->ComponentName);
            $component->ComponentName = $this->getComponentName($decodedComponentName, $locale);
    
            $additionalValues = $request->input("components.{$component->ComponentID}", []);
    
            if (is_array($additionalValues)) {
                foreach ($additionalValues as $value) {
                    $this->addComponentValue($component, $value, $selectedComponents, $request, $totalPrice);
                }
            } else {
                $this->addComponentValue($component, $additionalValues, $selectedComponents, $request, $totalPrice);
            }
    
            if (in_array('Other', (array)$additionalValues)) {
                $customValue = $request->input("custom_components.{$component->ComponentID}");
                $existingComponent = collect($selectedComponents)->firstWhere('component_id', $component->ComponentID);
                if ($customValue && !$existingComponent) {
                    $selectedComponents[] = [
                        'component_id' => $component->ComponentID,
                        'name'         => "{$component->ComponentName} (Custom)",
                        'value'        => (string)$customValue,
                        'price'        => 0
                        // 'value_id' => null
                    ];
                }
            }
        }
    }

    // Helper: Try to decode JSON; if it fails, return the raw input.
    private function decodeJsonOrRaw($input)
    {
        if (is_array($input)) {
            return $input;
        }
    
        $decoded = json_decode($input, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            return $decoded;
        }
    
        // Return raw input if not valid JSON
        return $input;
    }

    // Helper: Decode JSON string into an array with error handling.
    private function decodeJson($jsonString)
    {
        if (is_array($jsonString)) {
            return $jsonString;
        }
    
        $decoded = json_decode($jsonString, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            return $decoded;
        }
    
        Log::error('JSON decoding failed:', [
            'input' => $jsonString,
            'error' => json_last_error_msg()
        ]);
        return [];
    }

    // Helper: Get localized component name from decoded array.
    private function getComponentName($decodedArray, $locale)
    {
        Log::info('Attempting to get Component Name', ['locale' => $locale, 'decodedArray' => $decodedArray]);
        
        return $decodedArray[$locale]['ComponentName'] 
            ?? $decodedArray['en']['ComponentName'] 
            ?? (is_array($decodedArray) && isset(reset($decodedArray)['ComponentName']) 
                ? reset($decodedArray)['ComponentName'] 
                : 'Unnamed Component');
    }

    // Helper: Get localized component value name from decoded input.
    private function getComponentValueName($decodedArray, $locale)
    {
        Log::info('Attempting to get Component Value Name', ['locale' => $locale, 'decodedArray' => $decodedArray]);
        
        return $decodedArray[$locale]['ComponentValueName'] 
            ?? $decodedArray['en']['ComponentValueName'] 
            ?? (is_array($decodedArray) && isset(reset($decodedArray)['ComponentValueName']) 
                ? reset($decodedArray)['ComponentValueName'] 
                : 'Unnamed Value');
    }
}
