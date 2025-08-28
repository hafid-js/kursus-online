<?php

namespace App\Providers;

use App\Service\MidtransService;
use Illuminate\Support\ServiceProvider;

class MidtransServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(MidtransService::class, function () {
            return new MidtransService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // $paymentGatewaySetting = $this->app->make(MidtransService::class);
        // $paymentGatewaySetting->setGlobalSettings();
    }
}
