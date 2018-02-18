<?php
declare(strict_types=1);

namespace Trancended\ApiProduct\Http\Controllers;

use Illuminate\Http\Request;
use Trancended\ApiProduct\Repositories\Entities\Product;
use Trancended\ApiProduct\Http\Controllers\ApiController;
use Trancended\ApiProduct\Http\Requests\StoreProductPost;
use Trancended\ApiProduct\Dictionaries\Http;
use Trancended\ApiProduct\Repositories\ProductRepository;

class ProductController extends ApiController
{
    /**
     * @var ProductRepository
     */
    private $repository;

    /**
     *
     * @param ProductRepository $repository
     */
    public function __construct(ProductRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    /**
     * Show list od products
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $products = $this->repository->search($request);

        return $this->ShowAll($products);
    }

    /**
     * Show product
     *
     * @param  \Trancended\ApiProduct\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Product $product)
    {
        return $this->showOne($product);
    }

    /**
     * Create new product
     *
     * @param  StoreProductPost  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreProductPost $request)
    {
        $product = $this->repository->create($request->all());

        return $this->showOne($product, Http::HTTP_CREATED);
    }

    /**
     * Update product
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Trancended\ApiProduct\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Product $product)
    {
        $attributes = $request->only([
            'name',
            'amount',
        ]);

        $product->fill($attributes);

        if ($product->isClean()) {
            return $this->errorResponse(
                'You need to specify any different value to update',
                Http::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $this->repository->update($product->getAttribute('id'), $attributes);

        return $this->showOne($product);
    }

    /**
     * Delete product
     *
     * @param  \Trancended\ApiProduct\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return $this->showOne($product);
    }
}
