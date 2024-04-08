<?php

namespace App\Filament\Resources\GaleriaMultipleResource\Pages;

use App\Filament\Resources\GaleriaMultipleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGaleriaMultiple extends EditRecord
{
    protected static string $resource = GaleriaMultipleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
