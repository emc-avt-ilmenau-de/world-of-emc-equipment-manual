<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class thermocamcontroller extends Controller
{
    public function index() {
        $title = "Thermocam";      // set page title
        // hard coded pdf and bit file for downloading
        # $ex_pdf = Storage::download('file.jpg');
        # $ex_bitfile = Storage::download('file.jpg');
        return view('Frontend.thermocam', compact('title'));
    }
}
