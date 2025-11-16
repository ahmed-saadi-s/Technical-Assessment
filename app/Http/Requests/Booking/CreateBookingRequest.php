<?php

namespace App\Http\Requests\Booking;

use App\Enums\BookingStatus;
use App\Models\Booking;
use App\Traits\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;

class CreateBookingRequest extends FormRequest
{
    use ApiResponse;

    public function authorize(): bool
    {
        return auth()->user()?->can('create', Booking::class);
    }
    public function rules(): array
    {
        return [
            'customer_name' => 'required|string|max:100',
            'phone_number' => 'required|string|max:20',
            'booking_date'  => 'required|date_format:Y-m-d H:i',
            'service_type_id' => 'required|exists:service_types,id',
            'notes' => 'nullable|string|max:1000',
            'status' => 'required|in:' . implode(',', array_map(fn($s) => $s->value, BookingStatus::cases())),
        ];
    }
    public function messages(): array
    {
        return [
            'customer_name.required' => 'Please enter the customer name.',
            'customer_name.max' => 'Customer name cannot exceed 100 characters.',

            'phone_number.required' => 'Please enter the phone number.',
            'phone_number.max' => 'Phone number cannot exceed 20 characters.',

            'booking_date.required' => 'Please select the booking date.',
            'booking_date.date_format' => 'Please provide a valid date in YYYY-MM-DD HH:MM format.',

            'service_type_id.required' => 'Please select a service type.',
            'service_type_id.exists' => 'Selected service type does not exist.',

            'notes.max' => 'Notes cannot exceed 1000 characters.',

            'status.required' => 'Please select the booking status.',
            'status.in' => 'Selected status is invalid.',
        ];
    }
}
