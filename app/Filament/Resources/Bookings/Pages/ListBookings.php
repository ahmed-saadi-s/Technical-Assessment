<?php

namespace App\Filament\Resources\Bookings\Pages;

use App\Enums\BookingStatus;
use App\Filament\Resources\Bookings\BookingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;

class ListBookings extends ListRecords
{
    protected static string $resource = BookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
    // Defines the tabs for filtering Bookings by their status.
    public function getTabs(): array
    {
        return [
            null => Tab::make('All'),
            BookingStatus::PENDING->value => Tab::make('Pending')
                ->query(fn($query) => $query->where('status', BookingStatus::PENDING)),
            BookingStatus::CONFIRMED->value => Tab::make('Confirmed')
                ->query(fn($query) => $query->where('status', BookingStatus::CONFIRMED)),
            BookingStatus::CANCELLED->value => Tab::make('Cancelled')
                ->query(fn($query) => $query->where('status', BookingStatus::CANCELLED)),
        ];
    }
}
