<?php

namespace App\Http\Controllers\Api\Customer; // 🔥 Namespace diganti jadi Customer

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FaceShape;
use App\Models\Hairstyle;

class ExploreController extends Controller
{
    public function index()
    {
        try {
            // Ambil semua panduan bentuk wajah
            $faceShapes = FaceShape::all();

            // Ambil 10 gaya rambut secara ACAK biar tampilan dinamis
            $hairstyles = Hairstyle::inRandomOrder()->limit(10)->get();

            return response()->json([
                'status' => 'success',
                'data' => [
                    'face_shapes' => $faceShapes,
                    'hairstyles' => $hairstyles
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data eksplor: ' . $e->getMessage()
            ], 500);
        }
    }
}
