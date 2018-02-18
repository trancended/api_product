<?php
declare(strict_types=1);

namespace Trancended\ApiProduct\Traits;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Trancended\ApiProduct\Dictionaries\Http;
use Trancended\ApiProduct\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;

trait ApiPresenter
{
    use ApiResponser;

    /**
     *
     * @param Collection $collection
     * @param integer $code
     * @return JsonResponse
     */
    protected function showAll(Collection $collection, $code = Http::HTTP_OK): JsonResponse
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
     * @return JsonResponse
     */
    protected function showOne(Model $instance, $code = Http::HTTP_OK): JsonResponse
    {
        return $this->successResponse($instance, $code);
    }

    /**
     *
     * @param string $message
     * @param integer $code
     * @return JsonResponse
     */
    protected function showMessage($message, $code = Http::HTTP_OK): JsonResponse
    {
        return $this->successResponse($message, $code);
    }
}
