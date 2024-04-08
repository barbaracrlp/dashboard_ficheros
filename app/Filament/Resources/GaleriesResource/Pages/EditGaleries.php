<?php

namespace App\Filament\Resources\GaleriesResource\Pages;

use App\Filament\Resources\GaleriesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGaleries extends EditRecord
{
    protected static string $resource = GaleriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
