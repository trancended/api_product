<?php

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

		$collection = $this->cacheResponse($collection);

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

	/**
	 *
	 * @param array $data
	 * @return array
	 */
	protected function cacheResponse($data)
	{
		$url = request()->url();
		$queryParams = request()->query();

		ksort($queryParams);

		$queryString = http_build_query($queryParams);

		$fullUrl = "{$url}?{$queryString}";

		return Cache::remember($fullUrl, 30/60, function() use($data) {
			return $data;
		});
	}
	
}
