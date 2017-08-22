<?php

namespace Dialect\Unifaun;

use Illuminate\Support\ServiceProvider;

class UnifaunServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__.'/../config/unifaun.php';
        $this->publishes([$configPath => config_path('unifaun.php')], 'config');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('unifaun', Unifaun::class);
    }
}