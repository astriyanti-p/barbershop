<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\BarberProfile;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // ambil semua barber profile yang ada
        $barbers = BarberProfile::all();

        // kalau belum ada barber profile, jangan insert produk
        if ($barbers->count() == 0) {
            $this->command->info('Tidak ada barber profile, produk tidak dibuat.');
            return;
        }

        // buat produk untuk setiap barber
        foreach ($barbers as $barber) {
            Product::create([
                'barber_id' => $barber->id,
                'name' => 'Pomade Strong Hold',
                'description' => 'Pomade tahan lama',
                'price' => 75000,
                'stock' => 20,
                'status' => true,
            ]);

            Product::create([
                'barber_id' => $barber->id,
                'name' => 'Hair Tonic',
                'description' => 'Penyubur rambut',
                'price' => 50000,
                'stock' => 15,
                'status' => true,
            ]);
        }
    }
}
