<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class BookingController extends Controller
{
    /**
     * List all bookings (paginated)
     */
    public function index(Request $request): JsonResponse
    {
        $bookings = Booking::latest()
            ->paginate($request->get('per_page', 15));

        return response()->json([
            'success' => true,
            'data' => $bookings->items(),
            'meta' => [
                'current_page' => $bookings->currentPage(),
                'last_page'    => $bookings->lastPage(),
                'total'        => $bookings->total(),
            ]
        ]);
    }

    /**
     * Create a new booking
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:100',
            'phone'       => 'required|string|max:20',
            'email'       => 'nullable|email|max:150',
            'address'     => 'required|string|max:500',
            'services'    => 'required|array|min:1',
            'services.*'  => 'in:washing,dry_cleaning,ironing,blankets,wedding',
            'pickup_date' => 'required|date|after:today',
            'time_slot'   => 'required|string|max:60',
            'express'     => 'boolean',
            'notes'       => 'nullable|string|max:1000',
        ]);

        $booking = Booking::create([
            ...$validated,
            'services' => json_encode($validated['services']),
            'status'   => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Booking created successfully.',
            'data'    => $booking,
        ], 201);
    }

    /**
     * Show a single booking
     */
    public function show(string $id): JsonResponse
    {
        $booking = Booking::findOrFail($id);

        return response()->json([
            'success' => true,
            'data'    => $booking,
        ]);
    }

    /**
     * Cancel a booking
     */
    public function cancel(string $id): JsonResponse
    {
        $booking = Booking::findOrFail($id);

        if ($booking->status === 'cancelled') {
            return response()->json([
                'success' => false,
                'message' => 'Booking is already cancelled.',
            ], 422);
        }

        $booking->update(['status' => 'cancelled']);

        return response()->json([
            'success' => true,
            'message' => 'Booking cancelled successfully.',
            'data'    => $booking,
        ]);
    }
}
