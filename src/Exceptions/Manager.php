<?php
declare(strict_types=1);

namespace Trancended\ApiProduct\Exceptions;

use Exception;
use Trancended\ApiProduct\Exceptions\Types\NotFoundException;
use Trancended\ApiProduct\Exceptions\Types\QueryException;
use Trancended\ApiProduct\Exceptions\Types\MethodNotAllowed;
use Trancended\ApiProduct\Exceptions\Types\HttpException;
use Trancended\ApiProduct\Exceptions\Types\ValidationException;
use Trancended\ApiProduct\Exceptions\Types\UnexpectedException;

class Manager
{
    /**
     * @var Exception
     */
    private $exception;

    /**
     * @var array
     */
    private static $providers = [
        NotFoundException::class,
        QueryException::class,
        MethodNotAllowed::class,
        HttpException::class,
        ValidationException::class,
    ];

    /**
     * @param Exception $exception
     */
    public function __construct(Exception $exception)
    {
        $this->exception = $exception;
    }

    public function getError()
    {
        foreach (self::$providers as $class) {
            $strategy = new $class($this->exception);
            var_dump(get_class($this->exception));
            var_dump($class);
            var_dump($strategy->check());
            if ($strategy->check()) {
                return $strategy;
            }
        }

        var_dump($this->exception->getMessage());
        die();
        return new UnexpectedException($this->exception);
    }
}
