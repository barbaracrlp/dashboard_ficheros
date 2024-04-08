<?php

namespace App\Filament\Widgets;

use App\Models\Patient;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PatientTypeOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            //aqui definimos las estadisticas que queremos coger y or lo tanto mostrar en el widget
            Stat::make('Cats',Patient::query()->where('type','cat')->count()),
            Stat::make('Dogs',Patient::query()->where('type','dog')->count()),
            Stat::make('Dueños',Patient::query()->where('owner_id','3')->count()),
            Stat::make('Rabbits',Patient::query()->where('type','rabbit')->count()),
        ];
    }
}
