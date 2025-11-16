<?php

namespace App\Http\Resources\Booking;
use App\Http\Resources\ServiceType\ServiceTypeResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'customer_name'  => $this->customer_name,
            'phone_number'   => $this->phone_number,
            'booking_date'   => $this->booking_date,
            'service_type'   => new ServiceTypeResource($this->whenLoaded('serviceType')),
            'notes'          => $this->notes,
            'status'         => $this->status,
            'created_at'     => $this->created_at->toDateTimeString(),
            'updated_at'     => $this->updated_at->toDateTimeString(),
        ];
    }
}
