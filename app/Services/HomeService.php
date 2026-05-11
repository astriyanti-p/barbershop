<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class HomeService
{
    public function getMapShopsData()
    {
        $now = now();
        $currentTime = $now->format('H:i:s');
        $today = $now->format('Y-m-d');

        // Ambil data profil toko
        $shops = DB::table('barber_profiles')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        foreach ($shops as $shop) {
            // 🔥 PERBAIKAN: Menggunakan DATE_ADD, bukan TIME_ADD
            $isBusy = DB::table('orders')
                ->where('barber_id', $shop->user_id)
                ->where('booking_date', $today)
                ->where('booking_time', '<=', $currentTime)
                ->whereRaw("DATE_ADD(booking_time, INTERVAL 45 MINUTE) >= ?", [$currentTime])
                ->where('status', 'confirmed')
                ->exists();

            $shop->live_status = $isBusy ? "SEDANG MENCUKUR" : "KOSONG";
        }

        return $shops;
    }
}
