<?php

namespace Database\Seeders;

use App\Enums\BookingStatus;
use App\Enums\UserRole;
use App\Models\Booking;
use App\Models\ServiceType;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::factory()->count(5)->create();

        $services = ServiceType::factory()->count(5)->create();

        Booking::factory()->count(10)->make()->each(function ($booking) use ($services) {
            $booking->service_type_id = $services->random()->id;
            $booking->save();
        });
    }
}
