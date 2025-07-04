<?php

namespace App\Filament\Dashboard\Resources\AssetMaintenanceResource\Pages;

use App\Filament\Dashboard\Resources\AssetMaintenanceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAssetMaintenance extends EditRecord
{
    protected static string $resource = AssetMaintenanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
