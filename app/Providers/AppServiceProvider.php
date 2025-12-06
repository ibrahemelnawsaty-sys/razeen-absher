<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;

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
        
        // مشاركة بيانات SEO مع جميع الـ Views
        View::composer('*', function ($view) {
            static $seo = null;
            static $loaded = false;
            
            if (!$loaded) {
                try {
                    if (Schema::hasTable('seo_settings')) {
                        $seo = \App\Models\SeoSetting::first();
                    }
                } catch (\Exception $e) {
                    \Log::error('SEO Loading Error: ' . $e->getMessage());
                }
                $loaded = true;
            }
            
            $view->with('seoSettings', $seo);
        });
    }
}
