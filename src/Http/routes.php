<?php
Route::group(
    [
        'middleware' => ['api'],
        'prefix' => 'api/v1',
        'namespace' => 'Trancended\ApiProduct\Http\Controllers'],
    function () {
        Route::resource('products', 'ProductController', ['except' => ['create', 'edit']]);
    }
);
