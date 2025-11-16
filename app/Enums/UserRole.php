<?php

namespace App\Enums;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;
enum UserRole: string  implements  HasLabel,HasColor
{
    case ADMIN = 'admin';
    case STAFF = 'staff';

      public function getLabel(): string
    {
        return $this->value;
    }
     public function getColor() : string {
        return match ($this) {
       self::ADMIN=>'danger',
       self::STAFF=>'info'
    };
}
}
