<?php

namespace App\Providers;

use App\Billing\BankPaymentGateway;
use App\Billing\CreditPaymentGateway;
use App\Billing\PaymentGatewayContract;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        # singleton() initialize class once while bind() every time initialize
        $this->app->singleton(PaymentGatewayContract::class, function ($app) {
            # inside here we construct our payment gateway
            if (request()->has('credit')) { # It depends on use of in checkout he chooses credit card or bank
                return new CreditPaymentGateway('usd');
            }
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
