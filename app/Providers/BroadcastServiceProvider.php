<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // register the broadcast routes (e.g. /broadcasting/auth)
        // يمكنك إضافة middleware => ['auth:sanctum'] للمصادقة على القنوات الخاصة
        Broadcast::routes(['middleware' => ['web']]);

        // load channel authorization callbacks
        if (file_exists(base_path('routes/channels.php'))) {
            require base_path('routes/channels.php');
        }
    }
}
