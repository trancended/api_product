<?php

namespace Trancended\ApiProduct\Http\Controllers;

use Illuminate\Http\Request;
use Trancended\ApiProduct\ProductSearch\ProductSearch;
use Trancended\ApiProduct\Http\Controllers\ApiController;

class SearchController extends ApiController
{
    public function filter(Request $request)
    {
        return ProductSearch::apply($request);
    }
}
