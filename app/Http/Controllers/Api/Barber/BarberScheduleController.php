<?php

namespace App\Http\Controllers\Api\Barber;

use App\Http\Controllers\Controller;
use App\Models\BarberSchedule;
use Illuminate\Http\Request;

class BarberScheduleController extends Controller
{
    public function index(Request $request)
    {
        return BarberSchedule::where('barber_id', $request->user()->id)
            ->orderByRaw("
                FIELD(day_of_week,
                'monday','tuesday','wednesday',
                'thursday','friday','saturday','sunday')
            ")
            ->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'day_of_week' => 'required|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
            'start_time'  => 'required|date_format:H:i',
            'end_time'    => 'required|date_format:H:i|after:start_time',
            'is_active'   => 'boolean'
        ]);

        $exists = BarberSchedule::where('barber_id', $request->user()->id)
            ->where('day_of_week', $request->day_of_week)
            ->exists();

        if ($exists) {
            return response()->json([
                'message' => 'Schedule for this day already exists'
            ], 409);
        }

        $schedule = BarberSchedule::create([
            'barber_id'   => $request->user()->id,
            'day_of_week' => $request->day_of_week,
            'start_time'  => $request->start_time,
            'end_time'    => $request->end_time,
            'is_active'   => $request->is_active ?? true,
        ]);

        return response()->json([
            'message' => 'Schedule created successfully',
            'data' => $schedule
        ], 201);
    }

    public function update(Request $request, BarberSchedule $barberSchedule)
    {
        if ($barberSchedule->barber_id !== $request->user()->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $request->validate([
            'start_time' => 'required|date_format:H:i',
            'end_time'   => 'required|date_format:H:i|after:start_time',
            'is_active'  => 'boolean'
        ]);

        $barberSchedule->update([
            'start_time' => $request->start_time,
            'end_time'   => $request->end_time,
            'is_active'  => $request->is_active ?? $barberSchedule->is_active,
        ]);

        return response()->json([
            'message' => 'Schedule updated successfully',
            'data' => $barberSchedule
        ]);
    }

    public function destroy(Request $request, BarberSchedule $barberSchedule)
    {
        if ($barberSchedule->barber_id !== $request->user()->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $barberSchedule->delete();

        return response()->json([
            'message' => 'Schedule deleted successfully'
        ]);
    }
}