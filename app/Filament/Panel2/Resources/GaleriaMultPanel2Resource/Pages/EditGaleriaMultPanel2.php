<?php

namespace App\Filament\Panel2\Resources\GaleriaMultPanel2Resource\Pages;

use App\Filament\Panel2\Resources\GaleriaMultPanel2Resource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGaleriaMultPanel2 extends EditRecord
{
    protected static string $resource = GaleriaMultPanel2Resource::class;
    protected static ?string $title = 'Edit this Gallery';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
