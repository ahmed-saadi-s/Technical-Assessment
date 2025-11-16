<?php

namespace App\Filament\Resources\Bookings\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use App\Enums\BookingStatus;

class BookingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextInput::make('customer_name')
                    ->required()
                    ->maxLength(100),

                TextInput::make('phone_number')
                    ->required()
                    ->tel()
                    ->maxLength(20),

                DateTimePicker::make('booking_date')
                    ->required()
                    ->after(now()),

                Select::make('service_type_id')
                    ->relationship('serviceType', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Textarea::make('notes')
                    ->nullable()
                    ->maxLength(1000),

                Select::make('status')
                    ->options(BookingStatus::class)
                    ->required(),

            ]);
    }
}
