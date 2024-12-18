<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ComponentValue;
use App\Models\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Basketcontroller extends Controller
{
    public function show()
{
    $basket = session()->get('basket', []);

    Log::info('Basket contents: ' . json_encode($basket));

    // Return the basket view with the basket data
    return view('Frontend.basket', compact('basket'));
}


    // Update the product quantity in the basket
    public function update(Request $request, $productId)
{
    $basket = session()->get('basket', []);

    foreach ($basket as $key => $item) {
        if ($item['product_id'] == $productId) {
            // Ensure the 'product_price' key exists before accessing it
            if (!isset($item['product_price'])) {
                return redirect()->route('basket.show')->with('error', 'Product price is missing.');
            }

            // Get the new quantity from the request, default to 1 if not provided
            $quantity = $request->input('quantity', 1);

            // Update the quantity and total price
            $basket[$key]['quantity'] = $quantity;
            $basket[$key]['total_price'] = $item['product_price'] * $quantity;  // Calculate total price

            break;
        }
    }

    session(['basket' => $basket]);  // Save updated basket to session
    return redirect()->route('basket.show')->with('success', 'Basket updated successfully!');
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
