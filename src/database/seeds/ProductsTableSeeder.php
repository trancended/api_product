<?php
declare(strict_types=1);

namespace Trancended\ApiProduct\Database\Seeds;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Trancended\ApiProduct\Repositories\Entities\Product;

class ProductsTableSeeder extends Seeder
{

    private static $products = [
        [
            'name' => 'Produkt 1',
            'amount' => 4,
        ],
        [
            'name' => 'Produkt 2',
            'amount' => 12,
        ],
        [
            'name' => 'Produkt 5',
            'amount' => 0,
        ],
        [
            'name' => 'Produkt 7',
            'amount' => 6,
        ],
        [
            'name' => 'Produkt 8',
            'amount' => 2,
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();
        Product::flushEventListeners();

        foreach (self::$products as $data) {
            Product::create($data);
        }
    }
}
