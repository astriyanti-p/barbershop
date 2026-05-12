<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;

class BookingsController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with([
            'customer',
            'barber.barberProfile',
            'service' // 🔥 TAMBAH INI (penting buat kolom layanan)
        ]);

        // filter tanggal
        if ($request->filled('from')) {
            $query->whereDate('booking_date', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->whereDate('booking_date', '<=', $request->to);
        }

        // filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // filter shop
        if ($request->filled('shop')) {
            $query->whereHas('barber.barberProfile', function ($q) use ($request) {
                $q->where('shop_name', $request->shop);
            });
        }

        // search customer
        if ($request->filled('search')) {
            $query->whereHas('customer', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        $bookings = $query
    ->latest()
    ->paginate(10)
    ->withQueryString();

        // ambil list shop
        $shops = Order::with('barber.barberProfile')
            ->get()
            ->pluck('barber.barberProfile.shop_name')
            ->unique()
            ->filter();

        return view('admin.bookings', compact('bookings', 'shops'));
    }

    public function show($id)
    {
        $booking = Order::with([
            'customer',
            'barber.barberProfile',
            'service' // 🔥 TAMBAH INI JUGA
        ])->findOrFail($id);

       return view('admin.bookings-show', compact('booking'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled'
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return back()->with('success', 'Status booking berhasil diperbarui');
    }

    public function updatePaymentStatus(Request $request, $id)
    {
        $request->validate([
            'payment_status' => 'required|in:pending,paid,failed,expired,cancelled'
        ]);

        $order = Order::findOrFail($id);
        $order->payment_status = $request->payment_status;
        $order->save();

        return back()->with('success', 'Status pembayaran berhasil diperbarui');
    }

    public function destroy($id)
    {
        Order::findOrFail($id)->delete();

        return back()->with('success', 'Booking berhasil dihapus');
    }
    public function print(Request $request)
{
    $query = Order::with([
        'customer',
        'barber.barberProfile',
        'service'
    ]);

    if ($request->filled('from')) {
        $query->whereDate('booking_date', '>=', $request->from);
    }

    if ($request->filled('to')) {
        $query->whereDate('booking_date', '<=', $request->to);
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    if ($request->filled('shop')) {
        $query->whereHas('barber.barberProfile', function ($q) use ($request) {
            $q->where('shop_name', $request->shop);
        });
    }

    if ($request->filled('search')) {
        $query->whereHas('customer', function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%');
        });
    }

    $bookings = $query->latest()->get();

    return view('admin.bookings-print', compact('bookings'));
}
public function data(Request $request)
{
    $query = Order::with([
        'customer',
        'barber.barberProfile',
        'service'
    ]);

    // FILTER DATE
    if ($request->from) {
        $query->whereDate('booking_date', '>=', $request->from);
    }

    if ($request->to) {
        $query->whereDate('booking_date', '<=', $request->to);
    }

    // SHOP
    if ($request->shop) {
        $query->whereHas('barber.barberProfile', function ($q) use ($request) {
            $q->where('shop_name', $request->shop);
        });
    }

    // STATUS
    if ($request->status) {
        $query->where('status', $request->status);
    }

    // SEARCH CUSTOMER
    if ($request->search) {
        $query->whereHas('customer', function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%');
        });
    }

    $bookings = $query->orderBy('id', 'desc')
        ->paginate(10);

    return response()->json([
        'data' => $bookings->items(),
        'current_page' => $bookings->currentPage(),
        'last_page' => $bookings->lastPage(),
        'total' => $bookings->total(),
    ]);
}
}