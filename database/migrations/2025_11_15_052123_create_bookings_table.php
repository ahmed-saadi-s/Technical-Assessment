<?php

use App\Enums\BookingStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name', 100);
            $table->string('phone_number', 20);
            $table->dateTime('booking_date');
            $table->foreignId('service_type_id')->constrained('service_types')->cascadeOnDelete();
            $table->text('notes')->nullable();
            $table->string('status',10)->default(BookingStatus::PENDING);
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
