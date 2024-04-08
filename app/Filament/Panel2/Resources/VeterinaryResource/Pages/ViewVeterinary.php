<?php

namespace App\Filament\Panel2\Resources\VeterinaryResource\Pages;

use App\Filament\Panel2\Resources\VeterinaryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewVeterinary extends ViewRecord
{
    protected static string $resource = VeterinaryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
