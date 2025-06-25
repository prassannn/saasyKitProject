<?php

namespace App\Filament\Dashboard\Resources\AssetAssignmentResource\Pages;

use App\Filament\Dashboard\Resources\AssetAssignmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAssetAssignment extends EditRecord
{
    protected static string $resource = AssetAssignmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
