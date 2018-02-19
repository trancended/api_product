<?php
declare(strict_types=1);

namespace Trancended\ApiProduct\Exceptions\Types;

use Exception;
use Trancended\ApiProduct\Exceptions\Types\ApiException;
use Trancended\ApiProduct\Dictionaries\Http;

abstract class AbstractException implements ApiException
{
    protected $message;
    protected $code;
    protected $exception;
    protected $types = [];

    /**
     * @param Exception $exception
     */
    public function __construct(Exception $exception)
    {
        $this->exception = $exception;
        $this->message = Http::getMessage($this->code);
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return array
     */
    public function getTypes(): array
    {
        return $this->types;
    }

    /**
     * @return bool
     */
    public function check(): bool
    {
        foreach ($this->getTypes() as $type) {
            if ($this->exception instanceof $type) {
                return true;
            }
        }
        return false;
    }
}
