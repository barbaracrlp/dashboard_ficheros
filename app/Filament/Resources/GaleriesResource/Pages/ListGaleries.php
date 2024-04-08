<?php

namespace App\Filament\Resources\GaleriesResource\Pages;

use App\Filament\Resources\GaleriesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGaleries extends ListRecords
{
    protected static string $resource = GaleriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
