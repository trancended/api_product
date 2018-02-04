# api_product
rest api for products

# Installation
composer require trancended/api_product

php artisan vendor:publish
and select "Provider: Trancended\ApiProduct\ApiProductServiceProvider"

remember to set up the DB configuration

php artisan migrate

composer dump-autoload
php artisan db:seed --class=ProductsTableSeeder
