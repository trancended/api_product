<?php
declare(strict_types=1);

namespace Trancended\ApiProduct\Repositories;

use Illuminate\Http\Request;

interface ProductRepository
{
    public function getAll();

    public function search(Request $request);

    public function getById($id);

    public function create(array $attributes);

    public function update($id, array $attributes);

    public function delete($id);
}
