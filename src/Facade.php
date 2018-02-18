<?php
declare(strict_types=1);

namespace Trancended\ApiProduct;

use Illuminate\Support\Facades\Facade as BaseFacade;

class Facade extends BaseFacade
{

    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'api_product';
    }
}
