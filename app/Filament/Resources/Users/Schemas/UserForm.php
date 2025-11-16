<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use App\Enums\UserRole;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(50),

                TextInput::make('email')
                    ->required()
                    ->email()
                    ->unique()
                    ->maxLength(255),

                TextInput::make('password')
                    ->password()
                    ->minLength(8)
                    ->dehydrated(fn($state) => filled($state))
                    ->required(fn(string $context): bool => $context === 'create'),

                Select::make('role')
                    ->required()
                    ->options(UserRole::class)

            ]);
    }
}
