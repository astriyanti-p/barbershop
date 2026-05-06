<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;

class DataPengunjungController extends Controller
{
    public function index(Request $request)
{
    $query = Order::with(['barber','customer'])
        ->where('payment_status', 'paid');

    if ($request->filled('barber_id')) {
        $query->where('barber_id', $request->barber_id);
    }

    if ($request->filled('from')) {
        $query->whereDate('booking_date', '>=', $request->from);
    }

    if ($request->filled('to')) {
        $query->whereDate('booking_date', '<=', $request->to);
    }

    $visitors = $query->latest()->get();

    $totalVisitors = $visitors->unique('customer_id')->count();

     $barbers = User::where('role','barber')->get();
     
    return view('admin.data-pengunjung', [
        'visitors' => $visitors,
        'totalVisitors' => $totalVisitors
    ]);
}
}