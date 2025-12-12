<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful; // added

class Kernel extends HttpKernel
{
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class, // ✅ مهم
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class, // ✅ مهم
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
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