<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BarberProfile;

class BarberProfileSeeder extends Seeder
{
    public function run(): void
    {
        BarberProfile::create([
            'user_id' => 2,
            'bio' => 'Barber profesional dengan pengalaman 5 tahun.',
            'shop_name' => 'Budi Barber Studio',
            'latitude' => -7.8012345,
            'longitude' => 110.3645678,
            'rating' => 4.8,
        ]);
    }
}