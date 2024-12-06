<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ComponentValue;
use App\Models\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Basketcontroller extends Controller
{
    // Display the basket page
    public function show()
    {
        $basket = session()->get('basket', []);
        //dd($basket);

        // Log the basket contents for debugging
        Log::info('Basket contents: ' . json_encode($basket));

        // Iterate through the basket items and ensure components are properly formatted
        foreach ($basket as &$item) {
            foreach ($item['components'] as &$component) {
                if (is_array($component['value'])) {
                    // If 'value' is an array, join it into a string
                    $component['value'] = implode(', ', $component['value']);
                }
            }
        }

        // Return the basket view with the basket data
        return view('Frontend.basket', compact('basket'));
    }

    // Update the product quantity in the basket
    public function update(Request $request, $productId)
    {
        $basket = session()->get('basket', []);

        // Loop through the basket to find the product by product_id
        foreach ($basket as $key => $item) {
            if ($item['product_id'] == $productId) {
                // Get the new quantity from the request (default to 1 if not provided)
                $quantity = $request->input('quantity', 1);
                $basket[$key]['quantity'] = $quantity;

                // Update the total price based on the new quantity
                $basket[$key]['total_price'] = $item['product_price'] * $quantity;

                break;
            }
        }

        // Save the updated basket back to the session
        session(['basket' => $basket]);

        // Redirect back to the basket page
        return redirect()->route('basket.show');
    }

    // Remove a product from the basket
    public function remove($productId)
    {
        $basket = session()->get('basket', []);

        // Loop through the basket to find and remove the product
        foreach ($basket as $key => $item) {
            if ($item['product_id'] == $productId) {
                unset($basket[$key]);
                break;
            }
        }

        // Re-index the array to ensure there are no gaps
        session()->put('basket', array_values($basket));

        // Redirect back to the basket page with a success message
        return redirect()->route('basket.show')->with('success', 'Product removed from basket.');
    }
}
