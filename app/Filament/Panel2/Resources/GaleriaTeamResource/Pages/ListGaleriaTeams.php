<?php

namespace App\Filament\Panel2\Resources\GaleriaTeamResource\Pages;

use App\Filament\Panel2\Resources\GaleriaTeamResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGaleriaTeams extends ListRecords
{
    protected static string $resource = GaleriaTeamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
