<?php
declare(strict_types=1);

namespace Trancended\ApiProduct\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

trait ApiResponser
{
    /**
     *
     * @param array $data
     * @param integer $code
     * @return \Illuminate\Http\JsonResponse
     */
    private function successResponse($data, $code)
    {
        return response()->json(['data' => $data], $code);
    }

    /**
     *
     * @param string $message
     * @param integer $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function errorResponse($message, $code)
    {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }

    /**
     *
     * @param Collection $collection
     * @param integer $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function showAll(Collection $collection, $code = 200)
    {
        if ($collection->isEmpty()) {
            return $this->successResponse($collection, $code);
        }

        return $this->successResponse($collection, $code);
    }

    /**
     *
     * @param Model $instance
     * @param integer $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function showOne(Model $instance, $code = 200)
    {
        return $this->successResponse($instance, $code);
    }

    /**
     *
     * @param string $message
     * @param integer $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function showMessage($message, $code = 200)
    {
        return $this->successResponse($message, $code);
    }
}
