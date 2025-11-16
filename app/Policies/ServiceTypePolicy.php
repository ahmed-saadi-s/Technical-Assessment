<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\ServiceType;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ServiceTypePolicy
{
   public function viewAny(User $user): bool
    {
        return in_array($user->role, [UserRole::ADMIN, UserRole::STAFF]);
    }

    public function view(User $user): bool
    {
        return in_array($user->role, [UserRole::ADMIN, UserRole::STAFF]);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, [UserRole::ADMIN, UserRole::STAFF]);
    }
    
    public function update(User $user): bool
    {
        return in_array($user->role, [UserRole::ADMIN, UserRole::STAFF]);
    }

    public function delete(User $user): bool
    {
        return in_array($user->role, [UserRole::ADMIN, UserRole::STAFF]);
    }
}

