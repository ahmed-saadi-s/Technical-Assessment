<?php

namespace App\Filament\Resources\Users\Pages;

use App\Enums\UserRole;
use App\Filament\Resources\Users\UserResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
    // Defines the tabs for filtering users by their role.
    public function getTabs(): array
    {
        return [
            null => Tab::make('All'),
            UserRole::ADMIN->value => Tab::make('Admin')
                ->query(fn($query) => $query->where('role', UserRole::ADMIN)),
            UserRole::STAFF->value => Tab::make('Staff')
                ->query(fn($query) => $query->where('role', UserRole::STAFF)),

        ];
    }
}
