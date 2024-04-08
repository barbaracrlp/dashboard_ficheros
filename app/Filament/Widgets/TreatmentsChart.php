<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

use App\Models\Treatment;
use Illuminate\Support\Facades\DB;

class TreatmentsChart extends ChartWidget
{
    protected static ?string $heading = 'Treatments';

     /**la propiedad sort para mostrar cual de los widgets se mostrara en que orden */
     protected static ?int $sort=7;


    protected function getData(): array
    {
        // return [
        //     //
        // ];

        $data = Treatment::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
            DB::raw('COUNT(*) as total')
        )
        ->whereBetween('created_at', [
            now()->subYear(),
            now()
        ])
        ->groupBy('month')
        ->get();

    return [
        'datasets' => [
            [
                'label' => 'Treatments',
                'data' => $data->pluck('total')->toArray(),
            ],
        ],
        'labels' => $data->pluck('month')->toArray(),
    ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
