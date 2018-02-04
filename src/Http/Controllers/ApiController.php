<?php

namespace Trancended\ApiProduct\Http\Controllers;

use Trancended\ApiProduct\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Trancended\ApiProduct\Traits\ApiResponser;
use Trancended\ApiProduct\RestApiHandler;

class ApiController extends Controller
{
    use ApiResponser;

    public function __construct()
    {
    	$this->middleware('api');

        \App::singleton(
            \Illuminate\Contracts\Debug\ExceptionHandler::class,
            RestApiHandler::class
        );
    }

}
