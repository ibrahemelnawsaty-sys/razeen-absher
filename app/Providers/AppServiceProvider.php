<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force HTTPS in production
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
        
        // Custom storage URL for hosts without symlink support
        if (!file_exists(public_path('storage'))) {
            app('url')->macro('storage', function ($path = '') {
                return url('storage/' . ltrim($path, '/'));
            });
        }
    }
}
