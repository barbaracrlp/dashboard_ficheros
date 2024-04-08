<?php

namespace App\Filament\Resources\PatientResource\Pages;

use App\Filament\Resources\PatientResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPatient extends ViewRecord
{

    ///aqui puedo poner el enlaceurl a una pagina customizada que he creado yo 
    // protected static string $resource = PatientResource::class;

    // protected static string $view='Filament.Resources.PatientResource.Pages.paginaPropia';

    protected static string $resource = PatientResource::class;

}
