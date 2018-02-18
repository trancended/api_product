<?php
declare(strict_types=1);

namespace Trancended\ApiProduct\Exceptions\Types;

use Illuminate\Database\QueryException as ExceptionType;
use Trancended\ApiProduct\Exceptions\Types\AbstractException;
use Trancended\ApiProduct\Dictionaries\Http;

class QueryException extends AbstractException
{

    /**
     * @var int
     */
    protected $code = Http::HTTP_SERVICE_UNAVAILABLE;

    /**
     * @var array
     */
    protected $types = [
        ExceptionType::class,
    ];
}
