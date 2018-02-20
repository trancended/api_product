# api_product
rest api for products - laravel package

# Installation
composer require trancended/api_product

php artisan vendor:publish
and select "Provider: Trancended\ApiProduct\ApiProductServiceProvider"

remember to set up the DB configuration

php artisan migrate

composer dump-autoload
php artisan db:seed --class=ProductsTableSeeder

# Tests

In config/database.php file, set up sqlite configuration

...
'connections' => [

    'sqlite_testing' => [
        'driver' => 'sqlite',
        'database' => ':memory:',
        'prefix' => '',
    ],

