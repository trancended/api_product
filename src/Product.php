<?php
declare(strict_types=1);

namespace Trancended\ApiProduct;

use Illuminate\Database\Eloquent\Model;
use App\Transformers\ProductTransformer;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

    const STATUS_UNAVAILABLE = 0;
    const STATUS_AVAILABLE = 1;

    protected $fillable = [
        'name',
        'amount'
    ];

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = strtolower($name);
    }

    public function getNameAttribute($name)
    {
        return ucwords($name);
    }
}
