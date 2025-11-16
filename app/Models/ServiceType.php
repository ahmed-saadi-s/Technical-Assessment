<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceType extends Model
{
        use HasFactory;
    protected $fillable = [
        'name',
        'description'
    ];
    public function Booking(): HasMany
    {
        return $this->hasMany(ServiceType::class);
    }

    // Disable automatic timestamps (created_at & updated_at)
    public $timestamps = false;
}
