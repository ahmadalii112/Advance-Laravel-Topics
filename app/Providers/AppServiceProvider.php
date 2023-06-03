<?php

namespace App\Providers;

use App\Billing\BankPaymentGateway;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        # singleton() initialize class once while bind() every time initialize
        $this->app->singleton(BankPaymentGateway::class, function ($app) {
            # inside here we construct our payment gateway
            return new BankPaymentGateway('usd');
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
