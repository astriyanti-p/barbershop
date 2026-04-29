<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        Service::create([
            'barber_id' => 2,
            'name' => 'Haircut Premium',
            'description' => 'Potong rambut modern + styling',
            'price' => 50000,
            'duration' => 45,
            'status' => true,
        ]);

        Service::create([
            'barber_id' => 2,
            'name' => 'Beard Trim',
            'description' => 'Rapikan jenggot',
            'price' => 30000,
            'duration' => 20,
            'status' => true,
        ]);
    }
}