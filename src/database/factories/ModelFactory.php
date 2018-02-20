<?php
declare(strict_types=1);

namespace Trancended\ApiProduct\Factories;

use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Trancended\ApiProduct\Repositories\Entities\Product;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Product::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'amount' => $faker->numberBetween(0, 100),
    ];
});
