<?php

namespace App\Filament\Resources\ServiceTypes;

use App\Filament\Resources\ServiceTypes\Pages\ManageServiceTypes;
use App\Models\ServiceType;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;

class ServiceTypeResource extends Resource
{
    protected static ?string $model = ServiceType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                    TextInput::make('name')
                    ->required()
                    ->maxLength(50),

                TextInput::make('description')
                    ->nullable()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                     TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('description'),
            ])
            ->defaultSort('id','desc')
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                    DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageServiceTypes::route('/'),
        ];
    }
}


