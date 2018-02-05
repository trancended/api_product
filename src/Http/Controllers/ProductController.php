<?php

namespace Trancended\ApiProduct\Http\Controllers;

use Illuminate\Http\Request;
use Trancended\ApiProduct\Product;
use Trancended\ApiProduct\Http\Controllers\{ApiController, SearchController};

class ProductController extends ApiController
{

	/**
	 * Show list od products
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$products = (new SearchController())->filter($request);
		
		return $this->ShowAll($products);
	}

	/**
	 * Show product
	 *
	 * @param  \Trancended\ApiProduct\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function show(Product $product)
    {
        return $this->showOne($product);
    }

	/**
	 * Create new product
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$rules = [
			'name' => 'required',
			'amount' => 'required',
		];
		$this->validate($request, $rules);

		$product = Product::create($request->all());

		return $this->showOne($product, 201);
	}

	/**
	 * Update product
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Trancended\ApiProduct\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Product $product)
	{
		$product->fill($request->only([
			'name',
			'amount',
		]));

		if ($product->isClean()) {
			return $this->errorResponse('You need to specify any different value to update', 422);
		}

		$product->save();

		return $this->showOne($product);
	}

	/**
	 * Delete product
	 *
 	 * @param  \Trancended\ApiProduct\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Product $product)
	{
		$product->delete();

		return $this->showOne($product);
	}
}
