<?php

namespace App\Filament\Dashboard\Resources\AssetAssignmentResource\Pages;

use App\Filament\Dashboard\Resources\AssetAssignmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAssetAssignments extends ListRecords
{
    protected static string $resource = AssetAssignmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
