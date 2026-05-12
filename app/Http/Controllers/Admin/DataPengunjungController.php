<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;

class DataPengunjungController extends Controller
{
    /**
     * BASE QUERY (REUSABLE)
     */
    private function baseQuery(Request $request)
    {
        return Order::with([
                'barber.barberProfile',
                'customer',
                'service'
            ])
            ->where('payment_status', 'paid')

            ->when($request->shop, function ($q) use ($request) {
                $q->whereHas('barber.barberProfile', function ($q2) use ($request) {
                    $q2->where('shop_name', $request->shop);
                });
            })

            ->when($request->from_date, function ($q) use ($request) {
                $q->whereDate('booking_date', '>=', $request->from_date);
            })

            ->when($request->to_date, function ($q) use ($request) {
                $q->whereDate('booking_date', '<=', $request->to_date);
            })

            ->when($request->search, function ($q) use ($request) {
                $q->whereHas('customer', function ($q2) use ($request) {
                    $q2->where('name', 'like', '%' . $request->search . '%');
                });
            });
    }

    /**
     * PAGE VIEW
     */
    public function index(Request $request)
{
    $baseQuery = $this->baseQuery($request);

    // 🔥 HITUNG TOTAL SEBELUM PAGINATE
    $totalVisitors = (clone $baseQuery)->count();

    // 🔥 BARU PAGINATE
    $visitors = $baseQuery
        ->latest()
        ->paginate(10)
        ->withQueryString();

    $barbers = User::where('role', 'barber')->get();

    return view('admin.data-pengunjung', compact(
        'visitors',
        'totalVisitors',
        'barbers'
    ));
}

    /**
     * REAL-TIME AJAX DATA
     */
   public function data(Request $request)
{
    $visitors = $this->baseQuery($request)
        ->latest()
        ->paginate(10)
        ->withQueryString();

    return response()->json([
        'data' => $visitors->items(),
        'current_page' => $visitors->currentPage(),
        'last_page' => $visitors->lastPage(),
        'total' => $visitors->total(),
    ]);
}

    /**
     * PRINT PDF VIEW
     */
    public function print(Request $request)
{
    $visitors = $this->baseQuery($request)
        ->latest()
        ->get();

    return view('admin.visitors-print', [
        'visitors' => $visitors,
        'totalVisitors' => $visitors->count()
    ]);
}
}