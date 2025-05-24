<?php

namespace Zovix\Zovix;

use Illuminate\Support\ServiceProvider;
use Zovix\Zovix\Zovix;

class ZovixServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('zovix', function ($app) {
            return new Zovix();
        });

        $this->mergeConfigFrom(
            __DIR__.'/../config/zovix.php', 'zovix'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/zovix.php' => $this->app->configPath('zovix.php'),
            ], 'config');
        }
    }
} 