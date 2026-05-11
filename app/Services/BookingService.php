<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class BookingService
{
    public function getAllServices()
    {
        // Mengambil layanan beserta nama toko
        return DB::table('services')
            ->leftJoin('barber_profiles', 'services.barber_id', '=', 'barber_profiles.user_id')
            ->select('services.*', 'barber_profiles.shop_name')
            ->get();
    }

    public function getAvailableSlots()
    {
        // Mengirimkan slot jam kosong
        return [
            ["start" => "09:00", "available" => true],
            ["start" => "10:00", "available" => true],
            ["start" => "11:00", "available" => true],
            ["start" => "12:00", "available" => true],
            ["start" => "13:00", "available" => true],
            ["start" => "14:00", "available" => true],
            ["start" => "15:00", "available" => true],
            ["start" => "16:00", "available" => true],
            ["start" => "17:00", "available" => true],
            ["start" => "19:00", "available" => true],
            ["start" => "20:00", "available" => true],
            ["start" => "21:00", "available" => true],
            ["start" => "22:00", "available" => true],
            ["start" => "23:00", "available" => true],
        ];
    }
}
