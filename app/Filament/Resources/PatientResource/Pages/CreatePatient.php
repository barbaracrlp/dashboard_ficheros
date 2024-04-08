<?php

namespace App\Filament\Resources\PatientResource\Pages;

use App\Filament\Resources\PatientResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;



class CreatePatient extends CreateRecord
{
    protected static string $resource = PatientResource::class;

    // protected function getCreatedNotificationTitle(): ?string
    // {
    //     return 'El nuevo paciente se ha creado';
    // }

    //funcio per a crear notificacions personalitzades, dius en quin cas
    //un titulo y un cuerpo de la notificacion
      protected function getCreatedNotification(): ?Notification
      {
          return Notification::make()
          ->success()
          ->title('Paciente creado')
          ->body('El paciente ha sido creado correctamente');
      }



    /**si poner return null la notificacion no te aparece */
    //  protected function getCreatedNotification(): ?Notification
    //  {
    //      return null;

    //  }
}
