<?php
declare(strict_types=1);

namespace Trancended\ApiProduct\Exceptions\Types;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Trancended\ApiProduct\Exceptions\AbstractException;
use Trancended\ApiProduct\Dictionaries\Http;

class NotFoundException extends AbstractException
{
    /**
     * @var int
     */
    protected $code = Http::HTTP_NOT_FOUND;

    /**
     * @var array
     */
    protected $types = [
        ModelNotFoundException::class,
        NotFoundHttpException::class,
    ];
}
