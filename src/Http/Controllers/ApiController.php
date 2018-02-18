<?php
declare(strict_types=1);

namespace Trancended\ApiProduct\Http\Controllers;

use Trancended\ApiProduct\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Trancended\ApiProduct\Traits\ApiResponser;
use Trancended\ApiProduct\Exceptions\Handler as RestApiHandler;

class ApiController extends Controller
{
    use ApiResponser;

    public function __construct()
    {
        \App::singleton(
            ExceptionHandler::class,
            RestApiHandler::class
        );
    }
}
