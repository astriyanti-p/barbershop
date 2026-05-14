<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeService
{
    public function getMapShopsData()
    {
        $now = Carbon::now('Asia/Jakarta');
        $currentTime = $now->format('H:i:s');
        $today = $now->format('Y-m-d');
        $currentDay = strtolower($now->format('l')); // 'monday', 'tuesday', dst.

        // Ambil data profil toko yang koordinatnya tidak kosong
        $shops = DB::table('barber_profiles')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        $result = [];

        foreach ($shops as $shop) {
            // =========================================================
            // BAGIAN 1: LOGIKA JADWAL OPERASIONAL (BUKA / TUTUP)
            // =========================================================
            $schedule = DB::table('barber_schedules')
                ->where('barber_id', $shop->user_id)
                ->where('day_of_week', $currentDay)
                ->where('is_active', 1)
                ->first();

            $isOpen = false;
            $opHoursText = "TUTUP HARI INI";

            if ($schedule) {
                $startTime = $schedule->start_time;
                $endTime = $schedule->end_time;

                // Format untuk ditampilkan di Flutter (10:00:00 -> 10:00)
                $startFormatted = substr($startTime, 0, 5);
                $endFormatted = substr($endTime, 0, 5);
                $opHoursText = "{$startFormatted} - {$endFormatted} WIB";

                // Logika Cerdas: Shift Malam vs Shift Normal
                if ($startTime > $endTime) {
                    if ($currentTime >= $startTime || $currentTime <= $endTime) {
                        $isOpen = true;
                    }
                } else {
                    if ($currentTime >= $startTime && $currentTime <= $endTime) {
                        $isOpen = true;
                    }
                }
            }

            // =========================================================
            // BAGIAN 2: LOGIKA KESIBUKAN TOKO (SEDANG MENCUKUR / KOSONG)
            // =========================================================
            $isBusy = DB::table('orders')
                ->where('barber_id', $shop->user_id)
                ->where('booking_date', $today)
                ->where('booking_time', '<=', $currentTime)
                ->whereRaw("DATE_ADD(booking_time, INTERVAL 45 MINUTE) >= ?", [$currentTime])
                ->where('status', 'confirmed')
                ->exists();

            $liveStatus = $isBusy ? "SEDANG MENCUKUR" : "KOSONG";

            // =========================================================
            // BAGIAN 3: BUNGKUS DATA SESUAI PERMINTAAN FLUTTER
            // =========================================================
            $result[] = [
                'user_id' => $shop->user_id,
                'shop_name' => $shop->shop_name,
                'latitude' => (float) $shop->latitude,
                'longitude' => (float) $shop->longitude,
                'operational_hours' => $opHoursText,
                'status' => $isOpen ? "BUKA" : "TUTUP",
                'live_status' => $liveStatus
            ];
        }

        return $result; // Kembalikan array mentah ke Controller
    }
    public function getPopularServices()
    {
        return DB::table('services')
            ->join('barber_profiles', 'services.barber_id', '=', 'barber_profiles.user_id')
            // Kita hitung jumlah order untuk setiap service_id
            ->leftJoin('orders', 'services.id', '=', 'orders.service_id')
            ->select(
                'services.id',
                'services.name',
                'services.price',
                'services.photo',
                'barber_profiles.shop_name',
                DB::raw('COUNT(orders.id) as total_orders')
            )
            ->groupBy('services.id', 'services.name', 'services.price', 'services.photo', 'barber_profiles.shop_name')
            ->orderBy('total_orders', 'desc') // Urutkan dari yang paling banyak dipesan
            ->limit(6)
            ->get()
            ->map(function ($item) {
                // Beri URL foto jika ada, kalau tidak pakai placeholder gambar barbershop
                $item->image_url = $item->photo ? asset('storage/' . $item->photo) : "https://images.unsplash.com/photo-1503951914875-452162b0f3f1?q=80&w=500&auto=format&fit=crop";
                return $item;
            });
    }
}
