<?php
declare(strict_types=1);

namespace Trancended\ApiProduct\Services;

use Illuminate\Http\Request;
use Trancended\ApiProduct\ProductSearch\ProductSearch;

class SearchService
{
    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function filter(Request $request)
    {
        return ProductSearch::apply($request);
    }
}
