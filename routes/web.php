<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontEnd\minicamcontroller;
use App\Http\Controllers\FrontEnd\downloadscontroller;
use App\Http\Controllers\FrontEnd\thermocamcontroller;
use App\Http\Controllers\FrontEnd\lamp100controller;
use App\Http\Controllers\FrontEnd\lamp75controller;



Route::get('/', function () {
    return view('Frontend.index');
});


Route::get('/minicam', [minicamcontroller::class, 'index']);
Route::get('/downloads', [downloadscontroller::class, 'index']);
Route::get('/thermocam', [thermocamcontroller::class, 'index']);
Route::get('/lamp100',[lamp100controller::class, 'index']);
Route::get('/lamp75',[lamp75controller::class, 'index']);

 
