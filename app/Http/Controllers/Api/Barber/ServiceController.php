<?php

namespace App\Http\Controllers\Api\Barber;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        return Service::where('barber_id', $request->user()->id)->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'duration' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        $service = Service::create([
            'barber_id' => $request->user()->id,
            'name' => $request->name,
            'price' => $request->price,
            'duration' => $request->duration,
            'description' => $request->description,
        ]);

        return response()->json($service, 201);
    }

    public function update(Request $request, Service $service)
    {
        if ($service->barber_id !== $request->user()->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $service->update($request->only([
            'name', 'price', 'duration', 'description'
        ]));

        return response()->json($service);
    }

    public function destroy(Request $request, Service $service)
    {
        if ($service->barber_id !== $request->user()->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $service->delete();

        return response()->json(['message' => 'Deleted']);
    }
}