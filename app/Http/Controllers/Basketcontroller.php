<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ComponentValue;
use App\Models\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Basketcontroller extends Controller
{
    // Display basket
    public function show()
{
    $basket = session()->get('basket', []);
    $locale = app()->getLocale();

    $groupedBasket = collect($basket)->map(function ($item) use ($locale) {
        return [
            'product_id' => $item['product_id'],
            'product_name' => $item['product_name'],
            'base_price' => $item['base_price'],
            'total_price' => $item['total_price'],
            'quantity' => $item['quantity'],
            'components' => collect($item['components'])->map(function ($component) use ($locale) {
                $componentName = 'Custom Component';
                $componentValueName = $component['value'] ?? 'No Value Provided';

                // ✅ Special handling for "Power Plug" component
                if ($component['component_id'] == 4) { // Assuming ComponentID for Power Plug is 4
                    $powerPlugComponent = Component::find(4);
                    if ($powerPlugComponent) {
                        $decodedName = json_decode($powerPlugComponent->ComponentName, true);
                        $componentName = $decodedName[$locale]['ComponentName'] 
                                        ?? $decodedName['en']['ComponentName'] 
                                        ?? 'Power Plug';
                    }
                    if (is_array($componentValueName)) {
                        $componentValueName = implode(', ', array_map('strval', $componentValueName));
                    }
                } 
                // ✅ Handle other components with names stored as JSON
                else if (isset($component['name'])) {
                    $decodedName = json_decode($component['name'], true);
                    if (is_array($decodedName)) {
                        $componentName = $decodedName[$locale]['ComponentName'] 
                                        ?? $decodedName['en']['ComponentName'] 
                                        ?? $component['name'];
                    } else {
                        $componentName = $component['name'];
                    }
                }

                // ✅ Handle standard components with value_id
                if (!empty($component['value_id']) && $component['component_id'] != 4) {
                    $componentModel = Component::find($component['component_id']);
                    $componentValueModel = ComponentValue::find($component['value_id']);

                    if ($componentModel) {
                        $decodedComponentName = json_decode($componentModel->ComponentName, true);
                        $componentName = $decodedComponentName[$locale]['ComponentName'] 
                                        ?? $decodedComponentName['en']['ComponentName'] 
                                        ?? 'Unnamed Component';
                    }

                    if ($componentValueModel) {
                        $decodedValueName = json_decode($componentValueModel->ComponentValueName, true);
                        $componentValueName = $decodedValueName[$locale]['ComponentValueName'] 
                                            ?? $decodedValueName['en']['ComponentValueName'] 
                                            ?? 'Unnamed Value';
                    }
                }

                return [
                    'name' => $componentName,
                    'value' => $componentValueName
                ];
            })->toArray()
        ];
    })->toArray();

    return view('Frontend.basket', ['basket' => $groupedBasket, 'locale' => $locale]);
}




    // Update product quantity
    public function update(Request $request, $productId)
{
    $basket = session()->get('basket', []);

    foreach ($basket as $key => $item) {
        if ($item['product_id'] == $productId) {
            // Get the new quantity from the request, default to 1 if not provided
            $quantity = $request->input('quantity', 1);

            // Calculate the base product price
            $basePrice = $item['base_price'];

            // Calculate the total component price
            $componentPrice = collect($item['components'])->sum(function ($component) {
                return $component['price'] ?? 0; // Ensure each component has a price
            });

            // Calculate the total price (base price + component price) * quantity
            $basket[$key]['quantity'] = $quantity;
            $basket[$key]['total_price'] = ($basePrice + $componentPrice) * $quantity;

            break;
        }
    }

    session(['basket' => $basket]); // Save updated basket to session

    return redirect()->route('basket.show')->with('success', 'Basket updated successfully!');
}


    // Remove product from basket
    public function remove($productId)
    {
        $basket = session()->get('basket', []);
        foreach ($basket as $key => $item) {
            if ($item['product_id'] == $productId) {
                unset($basket[$key]);
                break;
            }
        }

        session()->put('basket', array_values($basket));
        return redirect()->route('basket.show')->with('success', 'Product removed from basket.');
    }
}