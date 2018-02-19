<?php
declare(strict_types=1);

namespace Trancended\ApiProduct\Exceptions\Types;

use Trancended\ApiProduct\Exceptions\Types\AbstractException;
use Trancended\ApiProduct\Dictionaries\Http;

class UnexpectedException extends AbstractException
{
    /**
     * @var int
     */
    protected $code = Http::HTTP_SERVICE_UNAVAILABLE;
}
