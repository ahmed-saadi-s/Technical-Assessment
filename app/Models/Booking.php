<?php

namespace App\Models;

use App\Enums\BookingStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
        use HasFactory;
    protected $fillable = [
        'customer_name',
        'phone_number',
        'booking_date',
        'service_type_id',
        'notes',
        'status',
    ];
    public function serviceType(): BelongsTo
    {
        return $this->belongsTo(ServiceType::class);
    }
    protected function casts(): array
    {
        return [
            'status' => BookingStatus::class, // Cast the status attribute to the BookingStatus Enum
        ];
    }
}
