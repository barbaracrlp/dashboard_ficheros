<?php

namespace App\Filament\Panel2\Widgets;

use App\Models\Patient;
use Filament\Facades\Filament;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class PatientPanel2Chart extends ChartWidget
{
    protected static ?string $heading = 'Patients';
    /**para cambiar el color la linea de debajo */

    protected static string $color='warning';

     /**la propiedad sort para mostrar cual de los widgets se mostrara en que orden */
     protected static ?int $sort=4;

    protected function getData(): array
    {
        /**Aqui para que no salgan todos debemos de poner una query en vez del modelo */
        $data = Trend::query(Patient::query()->whereBelongsTo(Filament::getTenant()))
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
        return 'bar';
    }
}
