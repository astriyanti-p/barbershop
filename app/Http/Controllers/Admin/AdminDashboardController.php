<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\BarberProfile;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // TOTAL BARBERSHOP
        $totalBarber = BarberProfile::count();

        // TOTAL USER
        $totalUsers = User::where('role','user')->count();

        // TOTAL SALDO SISTEM (dummy sementara)
        // misal setiap barber bayar biaya pendaftaran 100k
        $totalSaldo = $totalBarber * 100000;

        // DATA GRAFIK DUMMY (7 hari)
        $labels = [];
        $data = [];

        for ($i = 6; $i >= 0; $i--) {
            $labels[] = Carbon::today()->subDays($i)->format('D');
            $data[] = rand(5,20); // dummy chart
        }

        return view('admin.dashboard', compact(
            'totalBarber',
            'totalUsers',
            'totalSaldo',
            'labels',
            'data'
        ));
    }
}
