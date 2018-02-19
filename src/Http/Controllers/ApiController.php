<?php
declare(strict_types=1);

namespace Trancended\ApiProduct\Http\Controllers;

use Illuminate\Contracts\Debug\ExceptionHandler;
use Trancended\ApiProduct\Http\Controllers\Controller;
use Trancended\ApiProduct\Traits\ApiPresenter;
use Trancended\ApiProduct\Exceptions\Handler as RestApiHandler;

class ApiController extends Controller
{
    use ApiPresenter;

    public function __construct()
    {
        \App::singleton(
            ExceptionHandler::class,
            RestApiHandler::class
        );
    }
}
