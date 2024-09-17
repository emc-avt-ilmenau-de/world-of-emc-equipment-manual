<?php

namespace App\Http\Controllers;
use App\Models\Product;

use Illuminate\Http\Request;

class Productcontroller extends Controller
{
    public function index() {
        $title = "Product Selection";      // set page title
        $products = Product::all();

        // dd($products);    // debug and halt
        // print(gettype($products));
        foreach ($products as $prd) {
            print($prd);
            // print($value);
        }

        return view('FrontEnd.about', compact('title'));
    }
}
