<?php 
namespace Database\Factories;

use App\Models\Booking;
use App\Models\ServiceType;
use App\Enums\BookingStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition()
    {
        return [
            'customer_name' => $this->faker->name(),
            'phone_number' => $this->faker->phoneNumber(),
            'booking_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'service_type_id' =>null,
            'notes' => $this->faker->sentence(),
            'status' => $this->faker->randomElement([
                BookingStatus::PENDING,
                BookingStatus::CONFIRMED,
                BookingStatus::CANCELLED,
            ]),
        ];
    }
}
