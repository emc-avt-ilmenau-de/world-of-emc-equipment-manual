<?php


namespace App\Services;

use App\Models\Product;
use App\Models\ComponentValue;
use Illuminate\Support\Facades\Log;

class BasketService
{
    // Handle form submission and calculate total price
    public function processFormSubmission($request, Product $product)
    {
        $totalPrice = $product->ProductPrice;
        $selectedItems = [];
        $processedComponents = [];

        // Process all components
        foreach ($product->components as $component) {
            $componentId = $component->ComponentID;

            // Prevent duplicate processing
            if (isset($processedComponents[$componentId])) {
                continue;
            }

            $values = $request->components[$componentId] ?? [];

            // If no value selected, log and create default entry
            if (!$values) {
                Log::warning('No value selected for component:', ['component' => $component->ComponentName]);
                $selectedItems[] = $this->createDefaultComponentEntry($component); // Add default entry
            } else {
                foreach ($values as $value) {
                    $processedValue = $this->processComponentValue($component, $value);
                    $selectedItems[] = $processedValue;
                    $totalPrice += $processedValue['value_price']; // Update total price
                }
            }

            $processedComponents[$componentId] = true;
        }

        return ['selectedItems' => $selectedItems, 'totalPrice' => $totalPrice];
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

        // Find matching component value in the database
        $componentValue = $component->componentValues->where('ComponentValueName', $value)->first();

        if ($componentValue) {
            return [
                'component_id' => $component->ComponentID,
                'component_name' => $component->ComponentName,
                'value_id' => $componentValue->ComponentValueID,
                'value_name' => $componentValue->ComponentValueName,
                'value_price' => $componentValue->ComponentValuePrice ?? 0,
            ];
        }

        // If no predefined value is found, return custom input without price
        return [
            'component_id' => $component->ComponentID,
            'component_name' => $component->ComponentName,
            'value_id' => null,
            'value_name' => $value,
            'value_price' => 0, // Custom input has no price
        ];
    }

    // Update the basket session with selected items
    public function updateBasket($product, $selectedItems, $totalPrice)
    {
        $basket = session('basket', []);
    
        foreach ($basket as &$item) {
            if ($item['product_id'] === $product->ProductID) {
                $item['quantity'] += 1;
                $item['total_price'] += $totalPrice;
                $item['components'] = $selectedItems;
                session(['basket' => $basket]); // Save updated basket
                Log::info('Basket updated in session:', session('basket'));
                return $basket;
            }
        }
    
        // Add a new product to the basket
        $basket[] = [
            'product_id' => $product->ProductID,
            'product_name' => $product->ProductName,
            'product_price' => $product->ProductPrice,
            'currency' => $product->ProductCurrency,
            'components' => $selectedItems,
            'total_price' => $totalPrice,
            'quantity' => 1,
        ];
    
        session(['basket' => $basket]); // Save updated basket
        Log::info('New basket saved in session:', session('basket'));
        return $basket;
    }
    
}
