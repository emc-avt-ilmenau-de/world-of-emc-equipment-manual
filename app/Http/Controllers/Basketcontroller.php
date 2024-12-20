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
    
        $groupedBasket = collect($basket)->map(function ($item) {
            $components = collect($item['components'])->map(function ($component) {
                $value = $component['value'];
    
                // Handle array or single value
                if (is_array($value)) {
                    $value = implode(', ', $value); // Convert array to comma-separated string
                }
    
                return $component['name'] . ' (' . $value . ')';
            })->implode(', '); // Combine all components into a single string
    
            return [
                'product_id' => $item['product_id'],
                'product_name' => $item['product_name'],
                'base_price' => $item['base_price'],
                'total_price' => $item['total_price'],
                'quantity' => $item['quantity'],
                'components' => $components, // Aggregated components as a string
            ];
        });
    
        Log::info('Grouped Basket Contents:', $groupedBasket->toArray());
    
        return view('Frontend.basket', ['basket' => $groupedBasket]);
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