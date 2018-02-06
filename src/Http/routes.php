<?php
Route::resource('products', 'ProductController', ['except' => ['create', 'edit']]);
