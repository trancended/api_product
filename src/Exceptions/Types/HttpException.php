<?php
declare(strict_types=1);

namespace Trancended\ApiProduct\Exceptions\Types;

use Trancended\ApiProduct\Exceptions\Types\AbstractException;
use Symfony\Component\HttpKernel\Exception\HttpException as ExceptionType;

class HttpException extends AbstractException
{

    /**
     * @var array
     */
    protected $types = [
        ExceptionType::class,
    ];

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->exception->getMessage();
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->exception->getStatusCode();
    }
}
