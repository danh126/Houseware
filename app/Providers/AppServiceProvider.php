<?php

namespace App\Providers;

use App\Services\ShippingService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Đăng ký ShippingService
        $this->app->singleton(ShippingService::class, function ($app) {

            return new ShippingService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
