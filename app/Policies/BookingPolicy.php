<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Booking;
use App\Models\User;

class BookingPolicy
{

    public function viewAny(User $user): bool
    {
        return in_array($user->role, [UserRole::ADMIN, UserRole::STAFF]);
    }

    public function view(User $user, Booking $booking): bool
    {
        return in_array($user->role, [UserRole::ADMIN, UserRole::STAFF]);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, [UserRole::ADMIN, UserRole::STAFF]);
    }

    public function update(User $user, Booking $booking): bool
    {
        return in_array($user->role, [UserRole::ADMIN, UserRole::STAFF]);
    }

    public function delete(User $user, Booking $booking): bool
    {
        return in_array($user->role, [UserRole::ADMIN, UserRole::STAFF]);
    }
}
