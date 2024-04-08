<?php

namespace App\Filament\Widgets;

use App\Models\Patient;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class PatientAdminChart extends ChartWidget
{
    protected static ?string $heading = 'Patients';
    /**para cambiar el color la linea de debajo */

    protected static string $color='danger';

     /**la propiedad sort para mostrar cual de los widgets se mostrara en que orden */
     protected static ?int $sort=3;

    protected function getData(): array
    {
        $data = Trend::model(Patient::class)
        ->between(
            start: now()->startOfMonth(),
            end: now()->endOfMonth(),
        )
        ->perDay()
        ->count();
 
    return [
        'datasets' => [
            [
                'label' => 'Patients',
                'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
            ],
        ],
        'labels' => $data->map(fn (TrendValue $value) => $value->date),
    ];
        
    }

    protected function getType(): string
    {
        return 'line';
    }
}
