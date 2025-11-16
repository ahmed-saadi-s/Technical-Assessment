<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use App\Enums\BookingStatus;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BookingOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [

            Stat::make('Total Bookings', Booking::count())
                ->description('All bookings')
                ->color('secondary'),

            Stat::make('Pending Bookings', 
                Booking::where('status', BookingStatus::PENDING)->count()
            )
            ->description('Awaiting confirmation')
            ->color('warning'),

            Stat::make('Confirmed Bookings', 
                Booking::where('status', BookingStatus::CONFIRMED)->count()
            )
            ->description('Confirmed bookings')
            ->color('success'),

            Stat::make('Cancelled Bookings', 
                Booking::where('status', BookingStatus::CANCELLED)->count()
            )
            ->description('Cancelled')
            ->color('danger'),
        ];
    }
}
