<?php
declare(strict_types=1);

namespace Trancended\ApiProduct;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as BaseProvider;
use Illuminate\Routing\Router;
use Trancended\ApiProduct\Repositories\ProductRepository;
use Trancended\ApiProduct\Repositories\EloquentProduct;

class ServiceProvider extends BaseProvider
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
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerApiProduct();

        $this->app->singleton(ProductRepository::class, EloquentProduct::class);
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
}
