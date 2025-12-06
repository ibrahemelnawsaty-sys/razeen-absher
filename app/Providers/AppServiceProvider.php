<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\View\Composers\SeoComposer;

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
        
        // مشاركة بيانات SEO مع جميع الـ Views (ما عدا صفحات الأدمن)
        View::composer([
            'layouts.app',
            'layouts.guest', 
            'welcome',
            'home',
            'index',
            'layouts.main',
            'layouts.public',
            // أضف أي layouts أخرى تستخدمها
        ], SeoComposer::class);
    }
}
