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
}
