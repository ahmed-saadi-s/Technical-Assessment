<?php

namespace App\Models;


use App\Enums\UserRole;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Panel;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, HasApiTokens;


    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'role' => UserRole::class, // Cast the role attribute to the UserRole Enum
        ];
    }
    public function canAccessPanel(Panel $panel): bool
    {
        return in_array($this->role, [
            UserRole::ADMIN,
            UserRole::STAFF,
        ]);
    }
}
