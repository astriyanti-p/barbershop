<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderItem;

class OrderItemSeeder extends Seeder
{
    public function run(): void
    {
        OrderItem::create([
            'order_id' => 1,
            'item_type' => 'service',
            'item_id' => 1,
            'name_snapshot' => 'Haircut Premium',
            'price' => 50000,
            'qty' => 1,
            'subtotal' => 50000,
        ]);

        OrderItem::create([
            'order_id' => 1,
            'item_type' => 'product',
            'item_id' => 1,
            'name_snapshot' => 'Pomade Strong Hold',
            'price' => 75000,
            'qty' => 1,
            'subtotal' => 75000,
        ]);
    }
}