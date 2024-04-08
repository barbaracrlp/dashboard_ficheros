<?php

namespace App\Filament\Panel2\Resources;

use App\Filament\Panel2\Resources\PatientResource\Pages;
use App\Filament\Panel2\Resources\PatientResource\RelationManagers;
use App\Models\Patient;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationIcon =null;
    protected static ?string $title = 'Our Patients';

    protected static ?string $navigationGroup="Clinic";
    // //agrego las badges del numero total que hay
    // public static function getNavigationBadge(): ?string
    // {
    //     return static::getModel()::count();
    // }

    /**intento crear una badge pero que solo me diga los del equipo */
        public static function getNavigationBadge(): ?string
        {
            $tenant=Filament::getTenant();

            $patientCount= Patient::query()->where('team_id',$tenant->getKey())->count();

            return $patientCount>0? (string)$patientCount: null;
        }






    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'primary';
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //agregamos el formulario del recurso original 
                Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
            Forms\Components\Select::make('type')
                ->options([
                    'cat' => 'Gato',
                    'dog' => 'Perro',
                    'rabbit' => 'Otros',
                ])
                ->required(),
            Forms\Components\DatePicker::make('date_of_birth')
                ->native(false)
                ->displayFormat('d/m/Y')
                ->required()
                ->maxDate(now()),
            Forms\Components\Select::make('owner_id')
                ->relationship('owner', 'name')
                ->searchable()
                ->native(false)
                ->preload()
                ->createOptionForm([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('email')
                        ->label('Email Address')
                        ->email()
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('phone')
                        ->label('Phone Number')
                        ->tel()
                        ->required(),
                ])
                ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //copiamos las columnas del recurso original 
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('date_of_birth')->sortable()->label('Fecha de Nacimiento'),
                Tables\Columns\TextColumn::make('owner.name')->searchable()->label('Dueño'),
            ])
            ->filters([
                //
                  /**Hay diferentes tipos de filtros ver docs */
                  Tables\Filters\SelectFilter::make('type')
                  ->options([
                      'cat' => 'Cat',
                      'dog' => 'Dog',
                      'rabbit' => 'Rabbit',
                  ])
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'view' => Pages\ViewPatient::route('/{record}'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
        ];
    }
}
