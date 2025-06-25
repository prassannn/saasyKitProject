<?php

namespace App\Filament\Dashboard\Resources\AssetCategoryResource\Pages;

use App\Filament\Dashboard\Resources\AssetCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAssetCategory extends EditRecord
{
    protected static string $resource = AssetCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
