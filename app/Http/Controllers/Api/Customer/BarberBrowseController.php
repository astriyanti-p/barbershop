<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Service;
use App\Models\BarberSchedule;

class BarberBrowseController extends Controller
{
    // semua barber
    public function barbers()
    {
        return response()->json(
            User::where('role', 'barber')
                ->select('id', 'name', 'email')
                ->get()
        );
    }

    // detail barber + services + schedules
    public function barberDetail($id)
    {
        $barber = User::where('role', 'barber')
            ->select('id', 'name', 'email')
            ->findOrFail($id);

        $services = Service::where('barber_id', $id)->get();

        $schedules = BarberSchedule::where('barber_id', $id)
            ->where('is_active', true)
            ->get();

        return response()->json([
            'barber' => $barber,
            'services' => $services,
            'schedules' => $schedules
        ]);
    }

    // hanya services
    public function services($id)
    {
        return response()->json(
            Service::where('barber_id', $id)->get()
        );
    }

    // hanya schedules
    public function schedules($id)
    {
        return response()->json(
            BarberSchedule::where('barber_id', $id)
                ->where('is_active', true)
                ->get()
        );
    }
}