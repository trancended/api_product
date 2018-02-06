# api_product
rest api for products - laravel package

# Installation
composer require trancended/api_product

php artisan vendor:publish --provider="Trancended\ApiProduct\ServiceProvider"

php artisan vendor:publish --provider="Barryvdh\Cors\ServiceProvider"

remember to set up the DB configuration

php artisan migrate

php artisan db:seed --class="Trancended\ApiProduct\Database\Seeds\ProductsTableSeeder"
