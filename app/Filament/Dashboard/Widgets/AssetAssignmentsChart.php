<?php

namespace App\Filament\Dashboard\Widgets;

use App\Models\AssetAssignment;
use Filament\Widgets\ChartWidget;

class AssetAssignmentsChart extends ChartWidget
{
    protected static ?string $heading = 'Asset Assignments';

    protected function getData(): array
    {
       // Get count of assignments grouped by month (1-12)
       $monthlyData = AssetAssignment::selectRaw('MONTH(assigned_date) as month, COUNT(*) as total')
       ->groupBy('month')
       ->orderBy('month')
       ->pluck('total', 'month')
       ->toArray();

   // Create 12 months array with 0 default
   $data = array_fill(1, 12, 0);

   // Overwrite with actual data
   foreach ($monthlyData as $month => $count) {
       $data[$month] = $count;
   }

   return [
       'datasets' => [
           [
               'label' => 'Assigned Assets',
               'data' => array_values($data), // values only
           ],
       ],
       'labels' => [
           'January', 'February', 'March', 'April', 'May', 'June',
           'July', 'August', 'September', 'October', 'November', 'December'
       ],
   ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    public function getColumnSpan(): int | string
{
    return 1; // or 'full', 1, etc.
}


}
