<?php
declare(strict_types=1);

namespace Trancended\ApiProduct\Exceptions\Types;

use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException as ExceptionType;
use Trancended\ApiProduct\Exceptions\AbstractException;
use Trancended\ApiProduct\Dictionaries\Http;

class MethodNotAllowed extends AbstractException
{
    /**
     * @var int
     */
    protected $code = Http::HTTP_METHOD_NOT_ALLOWED;

    /**
     * @var array
     */
    protected $types = [
        ExceptionType::class,
    ];
}
