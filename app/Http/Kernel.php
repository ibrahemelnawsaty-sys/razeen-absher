<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful; // added

class Kernel extends HttpKernel
{
    protected $middlewareGroups = [
        'web' => [
            // ...existing code...
        ],

        'api' => [
            // Ensure SPA cookie-based requests are treated stateful by Sanctum
            EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            // ...existing api middleware...
        ],
    ];

    protected $middlewareAliases = [
        // ...existing code...
        'role' => \App\Http\Middleware\CheckRole::class,
    ];
}