<?php

namespace App\Providers;

use App\Models\Config;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
        // Schema::defaultStringLenght(100);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        config()->set('my',Config::all()->pluck('value','key')->toArray());
    }
}
