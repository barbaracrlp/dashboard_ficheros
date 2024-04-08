<?php

namespace App\Filament\Panel2\Pages\Tenancy;
 
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\EditTenantProfile;
 
class EditTeamProfile extends EditTenantProfile
{
    public static function getLabel(): string
    {
        return 'Perfil de Equipo';
    }
 
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
                TextInput::make('slug'),
                // ...
            ]);
    }
}





?>