<?php
declare(strict_types=1);

namespace Trancended\ApiProduct;

use Illuminate\Support\Facades\Facade;

class ApiProductFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'api_product';
    }
}
