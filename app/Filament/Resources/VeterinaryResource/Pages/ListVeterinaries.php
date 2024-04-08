<?php

namespace App\Filament\Resources\VeterinaryResource\Pages;

use App\Filament\Resources\VeterinaryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVeterinaries extends ListRecords
{
    protected static string $resource = VeterinaryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
