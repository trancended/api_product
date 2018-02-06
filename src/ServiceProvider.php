<?php
declare(strict_types=1);

namespace Trancended\ApiProduct;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Routing\Router;

class ServiceProvider extends RouteServiceProvider
{
    protected $defer = false;
    protected $namespace = 'Trancended\ApiProduct\Http\Controllers';

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {

        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('api_product.php'),
        ], 'api-config');

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        parent::boot();
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'api_product');

        $this->registerApiProduct();
    }

    private function registerApiProduct()
    {
        $this->app->bind('api_product', function ($app) {
            return new ApiProduct($app);
        });
    }

    public function provides()
    {
        return ['api_product'];
    }

    public function map()
    {
        Route::prefix('api/v1')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(__DIR__.'/Http/routes.php');
    }
}
