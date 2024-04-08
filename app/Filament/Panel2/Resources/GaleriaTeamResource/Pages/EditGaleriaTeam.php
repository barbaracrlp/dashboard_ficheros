<?php

namespace App\Filament\Panel2\Resources\GaleriaTeamResource\Pages;

use App\Filament\Panel2\Resources\GaleriaTeamResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGaleriaTeam extends EditRecord
{
    protected static string $resource = GaleriaTeamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
