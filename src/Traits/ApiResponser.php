<?php
declare(strict_types=1);

namespace Trancended\ApiProduct\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponser
{
    /**
     *
     * @param array $data
     * @param integer $code
     * @return JsonResponse
     */
    private function successResponse($data, $code): JsonResponse
    {
        return response()->json(['data' => $data], $code);
    }

    /**
     *
     * @param string $message
     * @param integer $code
     * @return JsonResponse
     */
    protected function errorResponse($message, $code): JsonResponse
    {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }
}
