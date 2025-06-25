<?php

namespace App\Filament\Dashboard\Resources;

use App\Filament\Dashboard\Resources\AssetResource\Pages;
use App\Filament\Dashboard\Resources\AssetResource\RelationManagers;
use App\Models\Asset;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AssetResource extends Resource
{
    protected static ?string $model = Asset::class;

    protected static ?string $navigationGroup = 'Assets';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()
                ,
        Select::make('asset_category_id')
            ->relationship('category', 'name')
            ->required(),
        TextInput::make('serial_no'),
        Select::make('condition')
            ->options([
                'new' => 'New',
                'used' => 'Used',
                'damaged' => 'Damaged',
            ])->default('new'),
        Select::make('status')
            ->options([
                'available' => 'Available',
                'assigned' => 'Assigned',
                'retired' => 'Retired',
            ])->default('available'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('category.name')->label('Category')->searchable()->sortable(),
                TextColumn::make('condition')->searchable()->sortable(),
                TextColumn::make('status')->searchable()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    public static function mutateFormDataBeforeCreate(array $data): array
    {
        $data['tenant_id'] = auth()->user()->tenant_id;
        return $data;
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAssets::route('/'),
            'create' => Pages\CreateAsset::route('/create'),
            'edit' => Pages\EditAsset::route('/{record}/edit'),
        ];
    }
    public static function canViewAny(): bool
{
    return auth()->check(); // or true for testing
}

public static function shouldRegisterNavigation(): bool
{
    return true;
}

}
