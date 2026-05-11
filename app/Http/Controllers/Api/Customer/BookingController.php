<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Services\BookingService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function getServices()
    {
        try {
            $services = $this->bookingService->getAllServices();
            return response()->json($services, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal memuat layanan'], 500);
        }
    }

    public function getSlots()
    {
        try {
            $slots = $this->bookingService->getAvailableSlots();
            return response()->json($slots, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal memuat jadwal'], 500);
        }
    }
}
