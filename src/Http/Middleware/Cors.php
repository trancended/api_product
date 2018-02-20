<?php
declare(strict_types=1);

namespace Trancended\ApiProduct\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Trancended\ApiProduct\Dictionaries\Http;

class Cors
{

    /**
     * Handle an incoming request.
     *
     * @param Request  $request
     * @param Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        header("Access-Control-Allow-Origin: *");

        $headers = [
            'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, DELETE',
            'Access-Control-Allow-Headers' => 'Content-Type'
        ];
        if ($request->getMethod() == "OPTIONS") {
            return \Response::make(Http::getMessage(Http::HTTP_OK), Http::HTTP_OK, $headers);
        }

        $response = $next($request);
        foreach ($headers as $key => $value) {
            $response->header($key, $value);
        }
        return $response;
    }
}
