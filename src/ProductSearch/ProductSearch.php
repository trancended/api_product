<?php
declare(strict_types=1);

namespace Trancended\ApiProduct\ProductSearch;

use Trancended\ApiProduct\Repositories\Entities\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class ProductSearch
{

    /**
     * Apply filters
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function apply(Request $request)
    {
        $query = static::applyDecoratorsFromRequest($request, (new Product)->newQuery());
        return static::getResults($query);
    }

    /**
     * Apply decorators from request
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    private static function applyDecoratorsFromRequest(Request $request, Builder $query)
    {
        foreach ($request->all() as $filterName => $value) {
            $decorator = static::createFilterDecorator($filterName);
            if (static::isValidDecorator($decorator)) {
                $query = $decorator::apply($query, $value);
            }
        }
        return $query;
    }

    /**
     * Generate decorator class
     *
     * @param string $name
     * @return string
     */
    private static function createFilterDecorator($name)
    {
        return __NAMESPACE__ . '\\Filters\\' . studly_case($name);
    }

    /**
     * Check decorator class exists
     *
     * @param string $decorator
     * @return boolean
     */
    private static function isValidDecorator($decorator)
    {
        return class_exists($decorator);
    }

    /**
     * Check decorator class exists
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private static function getResults(Builder $query)
    {
        return $query->get();
    }
}
