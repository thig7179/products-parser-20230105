<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container\Container;

class ProductServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/openfoodfacts.php', 'openfoodfacts');

        $this->app->singleton('openfoodfacts', function (Container $app) {
            return new OpenFoodFacts($app);
        });
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
                __DIR__.'/../config/openfoodfacts.php' => config_path('openfoodfacts.php'),
            ], 'config');
        }
    }
}
