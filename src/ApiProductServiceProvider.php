<?php

namespace Trancended\ApiProduct;

use Illuminate\Support\ServiceProvider;

class ApiProductServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/api_product.php' => config_path('api_product.php'),
    		], 'api_product');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom( __DIR__.'/../config/api_product.php', 'api_product');

    }

    public function provides() {
      return ['api_product'];
    }
}
