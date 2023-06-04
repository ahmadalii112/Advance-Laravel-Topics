<?php

namespace App\Providers;

use App\Models\Channel;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        # Option - 1 Every Single View => every time when our view load a query hit to the database so use this if it is necessary
        // View::share('channels', Channel::oldest('name')->get());

        # Option - 2 ViewComposer => we can specify one or many views by adding [] syntax
        View::composer(['post.*', 'channel.index'], function ($view) {
            $view->with('channels', Channel::oldest('name')->get());
        });
    }
}
