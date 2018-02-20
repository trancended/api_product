<?php
declare(strict_types=1);

namespace Trancended\ApiProduct;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as BaseProvider;
use Illuminate\Routing\Router;
use Trancended\ApiProduct\Repositories\ProductRepository;
use Trancended\ApiProduct\Repositories\EloquentProduct;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;

class ServiceProvider extends BaseProvider
{
    protected $defer = false;

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');

        $this->registerEloquentFactoriesFrom(__DIR__ . '/database/factories');

        $this->publishes([
            __DIR__ . '/database/seeds' => $this->app->databasePath() . '/seeds'
        ], 'api-product-seed');
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

    /**
     * Register factory files.
     *
     * @param  string  $path
     * @return void
     */
    protected function registerEloquentFactoriesFrom($path)
    {
        $this->app->make(EloquentFactory::class)->load($path);
    }


    public function provides()
    {
        return ['api_product'];
    }
}
