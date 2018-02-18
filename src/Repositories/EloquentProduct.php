<?php
declare(strict_types=1);

namespace Trancended\ApiProduct\Repositories;

use Illuminate\Http\Request;
use Trancended\ApiProduct\Repositories\Entities\Product;
use Trancended\ApiProduct\Services\SearchService;

class EloquentProduct implements ProductRepository
{
    /**
     * @var Product $model
     */
    private $model;

    /**
     *
     * @param Product $model
     */
    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    /**
     * Search by filter service.
     *
     * @param Request $request
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function search(Request $request)
    {
        $products = (new SearchService())->filter($request);
        return $products;
    }

    /**
     * Get all products
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * Get product by id
     *
     * @param integer $id
     *
     * @return Product
     */
    public function getById($id)
    {
        return $this->model->find($id);
    }

    /**
     * Create a new product
     *
     * @param array $attributes
     *
     * @return Product
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * Update a product
     *
     * @param integer $id
     * @param array $attributes
     *
     * @return Product
     */
    public function update($id, array $attributes)
    {
        return $this->model->find($id)->update($attributes);
    }

    /**
     * Delete a product
     *
     * @param integer $id
     *
     * @return boolean
     */
    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }
}
