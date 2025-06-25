<?php

namespace App\Filament\Dashboard\Widgets;

use App\Models\Asset;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AssetStatusOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Active Assets', Asset::where('status', 'Available')->count())
                ->description('Total number of available assets')
                ->descriptionIcon('heroicon-o-check-circle'),
            Stat::make('Assigned', Asset::where('status', 'Assigned')->count())
                ->description('Total number of assigned assets')
                ->descriptionIcon('heroicon-o-wrench'),
            Stat::make('Disposed', Asset::where('status', 'Retired')->count())
                ->description('Total number of retired assets')
                ->descriptionIcon('heroicon-o-trash'),
        ];
    }
    
}
