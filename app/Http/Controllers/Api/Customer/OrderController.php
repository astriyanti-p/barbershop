<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Service;
use App\Models\BarberSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

// Import package Midtrans
use Midtrans\Config;
use Midtrans\Snap;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'barber_id' => 'required|exists:users,id',
            'service_id'   => 'required|exists:services,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required|date_format:H:i',
            'notes'        => 'nullable|string'
        ]);

        $service = Service::findOrFail($request->service_id);

        if ($service->barber_id != $request->barber_id) {
            return response()->json(['message' => 'Layanan ini bukan milik barber yang dipilih.'], 400);
        }

        $dayName = strtolower(Carbon::parse($request->booking_date)->format('l'));
        $schedule = BarberSchedule::where('barber_id', $request->barber_id)
            ->where('day_of_week', $dayName)
            ->where('is_active', true)
            ->first();

        if (!$schedule) {
            return response()->json(['message' => 'Barber tidak tersedia pada hari yang dipilih.'], 400);
        }

        if ($request->booking_time < $schedule->start_time || $request->booking_time > $schedule->end_time) {
            return response()->json(['message' => 'Waktu booking berada di luar jam kerja barber.'], 400);
        }

        $existingOrder = Order::where('barber_id', $request->barber_id)
            ->where('booking_date', $request->booking_date)
            ->where('booking_time', $request->booking_time)
            ->whereIn('status', ['pending', 'confirmed'])
            ->exists();

        if ($existingOrder) {
            return response()->json(['message' => 'Jadwal pada jam tersebut sudah dipesan.'], 409);
        }

        DB::beginTransaction();
        try {
            // 1. Buat Data Pesanan
            $orderCode = 'ORD-' . strtoupper(Str::random(8));
            $user = $request->user(); // Data customer yang sedang login

            $order = Order::create([
                'customer_id'   => $user->id,
                'barber_id'     => $request->barber_id,
                'order_code'    => $orderCode,
                'order_type'    => 'booking',
                'total_amount'  => $service->price,
                'booking_date'  => $request->booking_date,
                'booking_time'  => $request->booking_time,
                'notes'         => $request->notes,
                'payment_status' => 'pending',
                'status'        => 'pending',
                'payment_gateway' => 'midtrans',
            ]);

            OrderItem::create([
                'order_id'       => $order->id,
                'item_type'      => 'service',
                'item_id'        => $service->id,
                'name_snapshot'  => $service->name,
                'price'          => $service->price,
                'qty'            => 1,
                'subtotal'       => $service->price,
            ]);

            // ==========================================
            // 2. LOGIKA MIDTRANS SNAP TOKEN
            // ==========================================
            // Set konfigurasi Midtrans dari file .env
            Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
            Config::$isSanitized = true;
            Config::$is3ds = true;

            Config::$curlOptions = [
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_HTTPHEADER => [],
            ];

            // Siapkan parameter data untuk dikirim ke Midtrans
            $params = [
                'transaction_details' => [
                    'order_id' => $orderCode, // Harus unik
                    'gross_amount' => (int) $service->price,
                ],
                'customer_details' => [
                    'first_name' => $user->name,
                    'email' => $user->email,
                ],
            ];

            // Minta Snap Token ke Midtrans
            $snapToken = Snap::getSnapToken($params);

            // Simpan token tersebut ke database orders kita
            $order->snap_token = $snapToken;
            $order->save();
            // ==========================================

            DB::commit();

            // 3. Kembalikan respons ke Flutter
            // 3. Kembalikan respons ke Flutter (Tanpa Snap Token)
            return response()->json([
                'message' => 'Pesanan dikirim! Menunggu konfirmasi kapster.',
                'order'   => $order->load('items')
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Gagal membuat pesanan.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function index(Request $request)
    {
        return Order::with(['items', 'barber'])
            ->where('customer_id', $request->user()->id)
            ->latest()
            ->get();
    }

    public function show(Request $request, Order $order)
    {
        if ($order->customer_id !== $request->user()->id) {
            return response()->json(['message' => 'Akses ditolak.'], 403);
        }
        return $order->load('items');
    }
}
