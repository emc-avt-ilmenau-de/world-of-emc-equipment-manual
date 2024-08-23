<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class lamp100controller extends Controller
{
    
    public function index() {
        $title = "Thermocam";      // set page title
        // hard coded pdf and bit file for downloading
        # $ex_pdf = Storage::download('file.jpg');
        # $ex_bitfile = Storage::download('file.jpg');
        return view('Frontend.lamp100', compact('title'));
    }
}
