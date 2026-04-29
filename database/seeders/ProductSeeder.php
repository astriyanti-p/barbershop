<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'barber_id' => 2,
            'name' => 'Pomade Strong Hold',
            'description' => 'Pomade tahan lama',
            'price' => 75000,
            'stock' => 20,
            'status' => true,
        ]);
    }
}