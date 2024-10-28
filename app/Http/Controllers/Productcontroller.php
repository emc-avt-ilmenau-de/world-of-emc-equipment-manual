<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ComponentValue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $locale;

    public function __construct()
    {
        $this->locale = session('locale', App::getLocale());
    }

    public function index()
    {
        Log::info('ProductController: Current application locale is ' . $this->locale);
        $products = Product::all()->map(function ($product) {
            return $this->mapProduct($product);
        });

        return view('Frontend.about', compact('products'));
    }

    private function mapProduct($product)
    {
        if (is_string($product->ProductMiniDescription)) {
            $product->ProductMiniDescription = json_decode($product->ProductMiniDescription, true);
        }

        if (is_string($product->ProductDescription)) {
            $product->ProductDescription = json_decode($product->ProductDescription, true);
        }

        $product->minidescription = $product->ProductMiniDescription[$this->locale]['ProductMiniDescription'] ?? 
                                    $product->ProductMiniDescription['en']['ProductMiniDescription'] ?? '';

        $product->description = $product->ProductDescription[$this->locale] ?? 
                                $product->ProductDescription['en'] ?? '';

        return $product;
    }

    public function show($id)
    {
        $product = Product::with(['components.values'])->where('ProductID', $id)->firstOrFail();
        return view('Frontend.show', compact('product'));
    }

    public function submit(Request $request, $id)
    {
        $request->validate([
            'components' => 'required|array',
            'components.*' => 'exists:component_values,id'
        ]);

        $product = Product::findOrFail($id);
        $selectedComponents = $request->components;

        $totalPrice = $product->price;

        foreach ($selectedComponents as $componentId => $valueId) {
            $componentValue = ComponentValue::find($valueId);
            if ($componentValue) {
                $totalPrice += $componentValue->additional_price;
            } else {
                Log::warning('Component value not found: ' . $valueId);
            }
        }

        return view('products.confirmation', compact('product', 'totalPrice'));
    }
}
