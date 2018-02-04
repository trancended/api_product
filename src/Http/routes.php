<?php
Route::resource('products', 'ProductController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
