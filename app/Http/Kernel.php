<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middlewareGroups = [
        'web' => [
            // Other middleware here...
            \App\Http\Middleware\LocaleMiddleware::class, // Make sure this line is present
            \App\Http\Middleware\EncryptCookies::class,


        ],

        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];
}
