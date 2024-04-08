<?php

namespace App\Filament\Panel2\Resources\GaleriaMultPanel2Resource\Pages;

use App\Filament\Panel2\Resources\GaleriaMultPanel2Resource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGaleriaMultPanel2 extends CreateRecord
{

    protected static ?string $title = 'Create Gallery';
    protected static string $resource = GaleriaMultPanel2Resource::class;
}
