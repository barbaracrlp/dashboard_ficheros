<?php

namespace App\Filament\Resources\PatientResource\Widgets;

use Filament\Widgets\ChartWidget;

class TypeChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        return [
            //
        ];
    }

    protected function getType(): string
    {
        return 'bubble';
    }
}
