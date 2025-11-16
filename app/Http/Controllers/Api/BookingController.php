<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Booking\CreateBookingRequest;
use App\Http\Resources\Booking\BookingResource;
use App\Models\Booking;
use Symfony\Component\HttpFoundation\JsonResponse;

class BookingController extends Controller
{
    public function store(CreateBookingRequest $request): JsonResponse
    {

        $booking = Booking::create([
            'customer_name'   => $request->customer_name,
            'phone_number'    => $request->phone_number,
            'booking_date'    => $request->booking_date,
            'service_type_id' => $request->service_type_id,
            'notes'           => $request->notes,
            'status'          => $request->status,
        ]);

        return $this->success(
            new BookingResource($booking->load('serviceType')),
            'Booking created successfully',
            201
        );
    }
}
