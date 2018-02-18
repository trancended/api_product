<?php
declare(strict_types=1);

namespace Trancended\ApiProduct\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Transformers\ProductTransformer;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'amount'
    ];

    /**
     * @param string $name
     */
    public function setNameAttribute(string $name): void
    {
        $this->attributes['name'] = strtolower($name);
    }

    /**
     * @param string $name
     * @return string
     */
    public function getNameAttribute(string $name): string
    {
        return ucwords($name);
    }
}
