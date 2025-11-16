<?php

namespace App\Filament\Resources\Bookings\Tables;

use App\Enums\BookingStatus;
use App\Models\Booking;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Illuminate\Support\Collection;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class BookingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer_name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('phone_number')
                    ->searchable(),

                TextColumn::make('booking_date')
                    ->dateTime('M d, Y h:i A')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('serviceType.name'),

                TextColumn::make('notes')
                    ->limit(5) 
                    ->tooltip(fn(Booking $record) => $record->notes)
                    ->wrap(),

                TextColumn::make('status')
                    ->badge()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->since()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->since()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('Service Type')
                    ->relationship('ServiceType', 'name'),

                Filter::make('booking_date')
                    ->schema([
                        DateTimePicker::make('Booking date from'),
                        DateTimePicker::make('Booking date to')
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when($data['Booking date from'], function (Builder $query, $data) {
                            return $query->where('booking_date', '>=', $data);
                        })
                            ->when($data['Booking date to'], function (Builder $query, $data) {
                                return $query->where('booking_date', '<=', $data);
                            });
                    }),
            ])
            ->recordActions([
                ActionGroup::make([
                    Action::Make("Update Status")
                        ->icon(Heroicon::OutlinedPencilSquare)
                        ->fillForm(function (Booking $booking) {
                            return ['booking_status' => $booking->status];
                        })
                        ->schema([
                            Select::make('booking_status')->options(BookingStatus::class)->required(),
                        ])
                        ->action(function (array $data, Booking $booking): void {
                            $booking->update(['status' => $data['booking_status']]);
                        }),
                    EditAction::make(),
                    DeleteAction::make()
                ])
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('Update Status')->icon(Heroicon::OutlinedPencilSquare)
                        ->schema([
                            Select::make('booking_status')->options(BookingStatus::class)->required(),
                        ])
                        ->action(function (array $data, Collection $bookings): void {
                            $bookings->each(fn($booking) => $booking->update([
                                'status' => $data['booking_status'],
                            ]));
                        })
                        ->deselectRecordsAfterCompletion(),
                    DeleteBulkAction::make(),
                ])
            ]);
    }
}
