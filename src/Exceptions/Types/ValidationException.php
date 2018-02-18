<?php
declare(strict_types=1);

namespace Trancended\ApiProduct\Exceptions\Types;

use Illuminate\Validation\ValidationException as ExceptionType;
use Trancended\ApiProduct\Dictionaries\Http;
use Trancended\ApiProduct\Exceptions\Types\AbstractException;

class ValidationException extends AbstractException
{

    /**
     * @var int
     */
    protected $code = Http::HTTP_UNPROCESSABLE_ENTITY;

    /**
     * @var array
     */
    protected $types = [
        ExceptionType::class,
    ];

    /**
     * @return string
     */
    public function getMessage():string
    {
        return $this->exception->validator->errors()->__toString();
    }
}
