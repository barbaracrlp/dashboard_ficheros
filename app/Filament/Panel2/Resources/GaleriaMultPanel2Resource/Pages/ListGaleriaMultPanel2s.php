<?php

namespace App\Filament\Panel2\Resources\GaleriaMultPanel2Resource\Pages;

use App\Filament\Panel2\Resources\GaleriaMultPanel2Resource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGaleriaMultPanel2s extends ListRecords
{

    protected static ?string $title = 'Your Gallery';

    protected static string $resource = GaleriaMultPanel2Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
