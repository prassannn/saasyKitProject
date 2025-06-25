<?php

namespace App\Filament\Dashboard\Resources;

use App\Filament\Dashboard\Resources\AssetAssignmentResource\Pages;
use App\Filament\Dashboard\Resources\AssetAssignmentResource\RelationManagers;
use App\Models\AssetAssignment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AssetAssignmentResource extends Resource
{
    protected static ?string $model = AssetAssignment::class;

    protected static ?string $navigationGroup = 'Assets';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('asset_id')
                    ->relationship('asset', 'name')
                    ->required(),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\DatePicker::make('assigned_date')
                    ->required(),
                Forms\Components\DatePicker::make('returned_date')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('asset.name')->searchable(),
                Tables\Columns\TextColumn::make('user.name')->searchable(),
                Tables\Columns\TextColumn::make('assigned_date')->date(),
                Tables\Columns\TextColumn::make('returned_date')->date(),
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
            'index' => Pages\ListAssetAssignments::route('/'),
            'create' => Pages\CreateAssetAssignment::route('/create'),
            'edit' => Pages\EditAssetAssignment::route('/{record}/edit'),
        ];
    }
}
