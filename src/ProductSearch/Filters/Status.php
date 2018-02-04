<?php

namespace Trancended\ApiProduct\ProductSearch\Filters;

use Illuminate\Database\Eloquent\Builder;
use Trancended\ApiProduct\Product;

class Status implements Filter
{
    /**
     * Apply a given search value to the builder instance.
     *
     * @param Builder $builder
     * @param mixed $value
     * @return Builder $builder
     */
    public static function apply(Builder $builder, $value)
    {
        switch ($value) {
            case Product::STATUS_AVAILABLE:
                $builder->where('amount', '>', 0);
                break;
            case Product::STATUS_UNAVAILABLE:
                $builder->where('amount', '=', 0);
                break;
            default:
                break;
        }
        return $builder;
    }
}
