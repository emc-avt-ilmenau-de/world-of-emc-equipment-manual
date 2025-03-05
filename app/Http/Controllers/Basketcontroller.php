<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ComponentValue;
use App\Models\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BasketController extends Controller
{
    // Display basket with localized names and component value names
    public function show()
    {
        $basket = session()->get('basket', []);
        $locale = app()->getLocale();
        
        // Collect all product, component, & value IDs for optimized DB queries
        $productIDs = [];
        $componentIDs = [];
        $valueIDs = [];

        foreach ($basket as $item) {
            $productIDs[] = $item['product_id'];
            foreach ($item['components'] as $component) {
                if (!empty($component['component_id'])) {
                    $componentIDs[] = $component['component_id'];
                }
                if (!empty($component['value_id'])) {
                    $valueIDs[] = $component['value_id'];
                }
            }
        }

        // Fetch all necessary records
        $products = Product::whereIn('ProductID', $productIDs)->get()->keyBy('ProductID');
        $components = Component::whereIn('ComponentID', $componentIDs)->get()->keyBy('ComponentID');
        $componentValues = ComponentValue::whereIn('ComponentValueID', $valueIDs)->get()->keyBy('ComponentValueID');

        // Format basket with proper localization
        $groupedBasket = collect($basket)->map(function ($item) use ($locale, $products, $components, $componentValues) {
            // Localize product name
            $product = $products[$item['product_id']] ?? null;
            $productName = $product 
                ? $this->decodeAndLocalize($product->ProductName, $locale, 'ProductName')
                : 'Unnamed Product';

            // Process components
            $formattedComponents = collect($item['components'])->map(function ($component) use ($locale, $components, $componentValues) {
                // Localize component name
                $componentName = (isset($component['component_id']) && isset($components[$component['component_id']]))
                    ? $this->decodeAndLocalize($components[$component['component_id']]->ComponentName, $locale, 'ComponentName')
                    : 'Custom Component';

                // Process component value
                $componentValue = 'No Value Provided';
                if (isset($component['value_id']) && isset($componentValues[$component['value_id']])) {
                    $rawValue = $componentValues[$component['value_id']]->ComponentValueName;
                    $decodedValue = $this->decodeJsonOrRaw($rawValue);
                    // Log for debugging
                    Log::info('Decoded ComponentValue', ['raw' => $rawValue, 'decoded' => $decodedValue, 'locale' => $locale]);
                    $componentValue = $this->getComponentValueName($decodedValue, $locale);
                } else {
                    $componentValue = is_string($component['value'])
                        ? trim($component['value'])
                        : 'Custom Input Provided';
                }

                return [
                    'name'  => $componentName,
                    'value' => $componentValue
                ];
            })->toArray();

            return [
                'product_id'   => $item['product_id'],
                'product_name' => $productName,
                'base_price'   => $item['base_price'],
                'total_price'  => $item['total_price'],
                'quantity'     => $item['quantity'],
                'components'   => $formattedComponents
            ];
        })->toArray();

        return view('Frontend.basket', ['basket' => $groupedBasket, 'locale' => $locale]);
    }

    // Update product quantity in basket
    public function update(Request $request, $productId)
    {
        $basket = session()->get('basket', []);

        if (isset($basket[$productId])) {
            $quantity = max(1, (int)$request->input('quantity', 1));
            $basePrice = $basket[$productId]['base_price'];
            $componentPrice = collect($basket[$productId]['components'])->sum('price');

            $basket[$productId]['quantity'] = $quantity;
            $basket[$productId]['total_price'] = ($basePrice + $componentPrice) * $quantity;

            session(['basket' => $basket]);
        }

        return redirect()->route('basket.show')->with('success', 'Basket updated successfully!');
    }

    // Remove product from basket
    public function remove($productId)
    {
        $basket = session()->get('basket', []);
        if (isset($basket[$productId])) {
            unset($basket[$productId]);
            session()->put('basket', $basket);
        }
        return redirect()->route('basket.show')->with('success', 'Product removed from basket.');
    }

    // Decode JSON and return localized value for a given key
    private function decodeAndLocalize($jsonString, $locale, $key)
    {
        $decoded = $this->decodeJson($jsonString);
        return $decoded[$locale][$key] ?? ($decoded['en'][$key] ?? 'Unnamed');
    }

    // Universal JSON decoder with error handling
    private function decodeJson($jsonString)
    {
        if (is_array($jsonString)) {
            return $jsonString;
        }
        $decoded = json_decode($jsonString, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            return $decoded;
        }
        Log::error('JSON decoding failed.', ['input' => $jsonString, 'error' => json_last_error_msg()]);
        return [];
    }
    
    // Helper: Attempt to decode JSON; if invalid, return the raw input.
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
    
    // Helper: Get localized component value name from decoded input (or raw text)
    private function getComponentValueName($input, $locale)
    {
        if (is_array($input)) {
            return $input[$locale]['ComponentValueName']
                ?? $input['en']['ComponentValueName']
                ?? (isset(reset($input)['ComponentValueName']) ? reset($input)['ComponentValueName'] : 'Unnamed Value');
        }
        // If input is not an array, assume it's plain text
        return trim($input);
    }
}
