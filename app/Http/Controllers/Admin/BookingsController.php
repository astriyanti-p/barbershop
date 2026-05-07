<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;

class BookingsController extends Controller
{
    /**
     * Tampilkan semua booking (orders)
     */
    public function index(Request $request)
{
    $query = Order::with([
        'customer',
        'barber.barberProfile'
    ]);

    // filter tetap (punyamu sudah benar)
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

    // 🔥 INI YANG KAMU LUPA
    $shops = Order::with('barber.barberProfile')
        ->get()
        ->pluck('barber.barberProfile.shop_name')
        ->unique()
        ->filter();

    return view('admin.bookings', compact('bookings', 'shops'));
}

    /**
     * Detail booking
     */
    public function show($id)
    {
        $booking = Order::with([
            'customer',
            'barber.barberProfile'
        ])->findOrFail($id);

        return view('admin.bookings.show', compact('booking'));
    }

    /**
     * Update status layanan (booking progress)
     */
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

    /**
     * Update payment status
     */
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

    /**
     * Hapus booking
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return back()->with('success', 'Booking berhasil dihapus');
    }
}
