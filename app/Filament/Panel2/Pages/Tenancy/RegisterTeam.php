<?php

namespace App\Filament\Panel2\Pages\Tenancy;
 
use App\Models\Team;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\RegisterTenant;
 
class RegisterTeam extends RegisterTenant
{
    public static function getLabel(): string
    {
        return 'Registro Equipo';
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
 
    protected function handleRegistration(array $data): Team
    {
        $team = Team::create($data);
 
        $team->members()->attach(auth()->user());
 
        return $team;
    }
}





?>