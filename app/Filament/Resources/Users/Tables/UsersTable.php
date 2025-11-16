<?php

namespace App\Filament\Resources\Users\Tables;

use App\Enums\UserRole;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('email')
                    ->searchable(),


                TextColumn::make('role')
                    ->badge(),

                TextColumn::make("created_at")
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make("updated_at")
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->defaultSort('created_at', 'desc')
            ->filters([])
            ->recordActions([
                ActionGroup::make([
                    Action::Make("Update Role")
                        ->icon(Heroicon::OutlinedPencilSquare)
                        ->fillForm(function (User $user) {
                            return ['role' => $user->role];
                        })
                        ->schema([
                            Select::make('role')->options(UserRole::class)->required(),
                        ])
                        ->action(function (array $data, User $user): void {
                            $user->update(['role' => $data['role']]);
                        }),
                    EditAction::make(),
                    DeleteAction::make()
                ])->visible(fn(User $record) => $record->id !== auth()->id()),
            ])
            ->toolbarActions([
                DeleteBulkAction::make(),

            ]);
    }
}
