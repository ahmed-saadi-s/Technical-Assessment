<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;

enum BookingStatus: string implements  HasLabel,HasColor
{
    case PENDING  = "pending";
    case CONFIRMED = 'confirmed';
    case CANCELLED = 'cancelled';

    public function getLabel(): string
    {
        return $this->value;
    }
    public function getColor() : string {
        return match ($this) {
            self::PENDING   => 'warning',
            self::CONFIRMED => 'success', 
            self::CANCELLED => 'danger',  
        };
    }
}
