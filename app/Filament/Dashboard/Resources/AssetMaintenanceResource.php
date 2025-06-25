<?php

namespace App\Filament\Dashboard\Resources;

use App\Filament\Dashboard\Resources\AssetMaintenanceResource\Pages;
use App\Filament\Dashboard\Resources\AssetMaintenanceResource\RelationManagers;
use App\Models\AssetMaintenance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AssetMaintenanceResource extends Resource
{
    protected static ?string $model = AssetMaintenance::class;

    protected static ?string $navigationGroup = 'Assets';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('asset_id')
                    ->relationship('asset', 'name')
                    ->required(),
                Forms\Components\Textarea::make('issue_description')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('reported_at')
                    ->required(),
                Forms\Components\DatePicker::make('resolved_at')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('asset.name')->searchable(),
                Tables\Columns\TextColumn::make('issue_description')->searchable(),
                Tables\Columns\TextColumn::make('reported_at')->date(),
                Tables\Columns\TextColumn::make('resolved_at')->date(),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAssetMaintenances::route('/'),
            'create' => Pages\CreateAssetMaintenance::route('/create'),
            'edit' => Pages\EditAssetMaintenance::route('/{record}/edit'),
        ];
    }
}
