<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ExploreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now('Asia/Jakarta');

        // ==========================================
        // 1. MASUKKAN DATA BENTUK WAJAH (Dapatkan ID-nya)
        // ==========================================
        $bulatId = DB::table('face_shapes')->insertGetId([
            'name' => 'Wajah Bulat',
            'description' => 'Butuh volume di atas agar wajah terlihat lebih panjang.',
            'suggestions' => 'Pompadour, Quiff, Faux Hawk',
            'icon' => 'https://cdn-icons-png.flaticon.com/512/3233/3233483.png', // Icon senyum bulat
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $kotakId = DB::table('face_shapes')->insertGetId([
            'name' => 'Wajah Kotak',
            'description' => 'Rahang tegas sangat cocok dengan potongan pendek yang rapi.',
            'suggestions' => 'Buzz Cut, Crew Cut, French Crop',
            'icon' => 'https://cdn-icons-png.flaticon.com/512/3233/3233485.png', // Icon senyum kotak
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $ovalId = DB::table('face_shapes')->insertGetId([
            'name' => 'Wajah Oval',
            'description' => 'Proporsi wajah ideal, cocok dengan hampir semua gaya rambut.',
            'suggestions' => 'Comma Hair, Mullet, Slicked Back',
            'icon' => 'https://cdn-icons-png.flaticon.com/512/3233/3233474.png', // Icon senyum oval
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // ==========================================
        // 2. MASUKKAN DATA KATALOG GAYA RAMBUT
        // ==========================================
        $hairstyles = [
            // Kategori Kotak
            [
                'face_shape_id' => $kotakId,
                'name' => 'Textured French Crop',
                'category' => 'PENDEK',
                'image' => 'https://images.unsplash.com/photo-1622286342621-4bd786c2447c?w=500&q=80',
                'description' => 'Potongan pendek dengan poni depan bertekstur, menonjolkan garis rahang.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'face_shape_id' => $kotakId,
                'name' => 'Military Buzz Cut',
                'category' => 'PENDEK',
                'image' => 'https://images.unsplash.com/photo-1517832606299-7ae9b720a186?w=500&q=80',
                'description' => 'Potongan super cepak ala militer yang sangat maskulin.',
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Kategori Bulat
            [
                'face_shape_id' => $bulatId,
                'name' => 'Classic Pompadour',
                'category' => 'KLASIK',
                'image' => 'https://images.unsplash.com/photo-1599351431202-1e0f0137899a?w=500&q=80',
                'description' => 'Volume tinggi di bagian atas memberikan ilusi wajah yang lebih panjang.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'face_shape_id' => $bulatId,
                'name' => 'Modern Quiff',
                'category' => 'TRENDI',
                'image' => 'https://images.unsplash.com/photo-1503951914875-452162b0f3f1?w=500&q=80',
                'description' => 'Mirip pompadour namun lebih berantakan dan natural.',
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Kategori Oval
            [
                'face_shape_id' => $ovalId,
                'name' => 'Korean Comma Hair',
                'category' => 'K-STYLE',
                'image' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=500&q=80',
                'description' => 'Gaya poni melengkung ke dalam menyerupai tanda koma, sangat populer.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'face_shape_id' => $ovalId,
                'name' => 'Messy Mullet',
                'category' => 'TRENDI',
                'image' => 'https://images.unsplash.com/photo-1582233479966-1e0e8549642a?w=500&q=80',
                'description' => 'Pendek di samping dan depan, namun panjang di bagian belakang leher.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('hairstyles')->insert($hairstyles);
    }
}
