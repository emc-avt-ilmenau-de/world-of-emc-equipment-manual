<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\LocaleMiddleware::class, // Ensure this is at the top
            \Illuminate\Session\Middleware\StartSession::class,
           
            
            // Other middleware...
        ],
    ];
}
