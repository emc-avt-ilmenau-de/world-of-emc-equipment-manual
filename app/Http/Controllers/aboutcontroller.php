<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class aboutcontroller extends Controller
{
    public function index() {
        $title = "About Us";      // set page title
        // hard coded pdf and bit file for downloading
        # $ex_pdf = Storage::download('file.jpg');
        # $ex_bitfile = Storage::download('file.jpg');
        return view('Frontend.about', compact('title'));
    }
}
