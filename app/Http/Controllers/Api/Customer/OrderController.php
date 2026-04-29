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

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'barber_id'    => 'required|exists:users,id',
            'service_id'   => 'required|exists:services,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required|date_format:H:i',
            'notes'        => 'nullable|string'
        ]);

        $service = Service::findOrFail($request->service_id);

        if ($service->barber_id != $request->barber_id) {
            return response()->json([
                'message' => 'Service does not belong to selected barber'
            ], 400);
        }

        $dayName = strtolower(Carbon::parse($request->booking_date)->format('l'));

        $schedule = BarberSchedule::where('barber_id', $request->barber_id)
            ->where('day_of_week', $dayName)
            ->where('is_active', true)
            ->first();

        if (!$schedule) {
            return response()->json([
                'message' => 'Barber is not available on selected day'
            ], 400);
        }

        if (
            $request->booking_time < $schedule->start_time ||
            $request->booking_time > $schedule->end_time
        ) {
            return response()->json([
                'message' => 'Booking time is outside barber working hours'
            ], 400);
        }

        $existingOrder = Order::where('barber_id', $request->barber_id)
            ->where('booking_date', $request->booking_date)
            ->where('booking_time', $request->booking_time)
            ->whereIn('status', ['pending', 'confirmed'])
            ->exists();

        if ($existingOrder) {
            return response()->json([
                'message' => 'Selected time slot is already booked'
            ], 409);
        }

        $order = Order::create([
            'customer_id'   => $request->user()->id,
            'barber_id'     => $request->barber_id,
            'order_code'    => 'ORD-' . strtoupper(Str::random(8)),
            'order_type'    => 'booking',
            'total_amount'  => $service->price,
            'booking_date'  => $request->booking_date,
            'booking_time'  => $request->booking_time,
            'notes'         => $request->notes,
            'payment_status'=> 'pending',
            'status'        => 'pending',
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

        return response()->json([
            'message' => 'Order created successfully',
            'order'   => $order->load('items')
        ], 201);
    }

    public function index(Request $request)
    {
        return Order::with('items')
            ->where('customer_id', $request->user()->id)
            ->latest()
            ->get();
    }

    public function show(Request $request, Order $order)
    {
        if ($order->customer_id !== $request->user()->id) {
            return response()->json([
                'message' => 'Forbidden'
            ], 403);
        }

        return $order->load('items');
    }
}