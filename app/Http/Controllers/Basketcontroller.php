<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ComponentValue;
use App\Models\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class Basketcontroller extends Controller
{
    // Display the basket page
    public function show()
    {
        // Get basket data from the session
        $basket = session('basket', []);

        // Calculate total price for all items in the basket
        $totalPrice = array_sum(array_column($basket, 'total_price'));

        // Pass basket data and total price to the view
        return view('Frontend.basket', compact('basket', 'totalPrice'));
    }

    // Add a product to the basket
    public function add(Request $request, $id)
    {
        // Fetch product by ID
        $product = Product::findOrFail($id);

        // Initialize components array and total price
        $selectedComponents = [];
        $totalPrice = $product->ProductPrice;

        // Loop through selected components
        foreach ($request->components as $componentId => $values) {
            // Find the component by ID
            $component = Component::find($componentId);

            foreach ($values as $key => $value) {
                // Handling different component types based on the selected values
                if (is_array($value)) {
                    // For multiple values (checkboxes or multiple selection)
                    foreach ($value as $valId) {
                        $componentValue = ComponentValue::find($valId);
                        $selectedComponents[] = [
                            'component_name' => $component->ComponentName,
                            'value_name' => $componentValue->ComponentValueName,
                            'value_price' => $componentValue->ComponentValuePrice,
                        ];
                        $totalPrice += $componentValue->ComponentValuePrice; // Add to the total price
                    }
                } else {
                    // For single value (radio buttons or text fields)
                    $componentValue = ComponentValue::find($value);
                    $selectedComponents[] = [
                        'component_name' => $component->ComponentName,
                        'value_name' => $componentValue->ComponentValueName,
                        'value_price' => $componentValue->ComponentValuePrice,
                    ];
                    $totalPrice += $componentValue->ComponentValuePrice; // Add to the total price
                }

                // Special handling for "Other" fields like lens_otherField or geo_otherField
                if ($key === 'lens_otherField' || $key === 'geo_otherField') {
                    $selectedComponents[] = [
                        'component_name' => $component->ComponentName,
                        'value_name' => $value, // "Other" field value
                        'value_price' => 0, // Assuming no additional cost for "Other"
                    ];
                }
            }
        }

        // Get the existing basket data from the session
        $basket = session()->get('basket', []);

        // If the product already exists in the basket, update it, else add a new product
        if (isset($basket[$product->id])) {
            $basket[$product->id]['components'] = array_merge($basket[$product->id]['components'], $selectedComponents);
            $basket[$product->id]['total_price'] += $totalPrice;  // Add to the existing total price
        } else {
            $basket[$product->id] = [
                'product_id' => $product->id, // Add the product ID here
                'product_name' => $product->ProductName,
                'product_price' => $product->ProductPrice,
                'currency' => $product->ProductCurrency,
                'components' => $selectedComponents,
                'total_price' => $totalPrice,
            ];
        }

        // Store the updated basket in the session
        session(['basket' => $basket]);

        return redirect()->route('basket.show');
    }

    // Update the product quantity in the basket
    public function updateQuantity(Request $request, $productId)
    {
        // Retrieve the basket data from the session
        $basket = session('basket', []);

        // Check if the product exists in the basket
        if (isset($basket[$productId])) {
            // Get the product from the basket
            $product = $basket[$productId];
            
            // Get the quantity from the form (or default to 1 if not provided)
            $quantity = (int) $request->input('quantity', 1);
            
            // Update the quantity in the basket
            $basket[$productId]['quantity'] = $quantity;
    
            // Update the total price for this product
            $productTotalPrice = $product['product_price'] * $quantity;
            $basket[$productId]['total_price'] = $productTotalPrice;
    
            // Recalculate the overall total price
            $totalPrice = array_sum(array_column($basket, 'total_price'));
            $basket['totalPrice'] = $totalPrice;
        }
    
        // Store the updated basket back in the session
        session(['basket' => $basket]);
    
        // Redirect back to the basket page
        return redirect()->route('basket.show');
    }
    

    // Remove a product from the basket
    public function remove($productId)
{
    // Get the current basket from session
    $basket = session()->get('basket', []);
    
    // Find and remove the product from the basket by productId
    foreach ($basket as $key => $item) {
        if ($item['product_id'] == $productId) {
            unset($basket[$key]);
            break;
        }
    }

    // Save the updated basket back to session
    session()->put('basket', array_values($basket));  // Reindex the array

    // Redirect back to the basket page with a success message
    return redirect()->route('basket.show')->with('success', 'Product removed from basket.');
}
}
