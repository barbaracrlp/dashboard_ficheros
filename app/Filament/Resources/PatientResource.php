<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientResource\Pages;
use App\Filament\Resources\PatientResource\RelationManagers;
use App\Filament\Resources\PatientResource\Widgets\TypeChart;
use App\Models\Patient;
use Filament\Forms;
// use Filament\Forms\Components\Section as FormSection;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Support\Htmlable;

use Filament\Notifications\Notification;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup="Patients";
    /**Para la busqueda global necesitas definir un metodo de busqueda global el att es el de arriba*/
    // public static function getGlobalSearchResultTitle(Model $record): string|Htmlable
    // {
    //     return $record->last
    // }

    //crees manualment el formulario
    /**Para crear un formulario que corresponda con las foreignkeys 
     * relationships('funcion del modelo donde esta la relacion','att de la tabla que quieres que aparezca')
     */

    /**Puedes crear otro formulario correspondiente a otro modelo dentro del formulario de un modelo
     * mirar el final createOptionForm()
     */

    /**
     * validacion telefono : tel()
     *valiacion email: email()
     */

    /**tiqueta en la barra de navegacion  */
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'primary';
    }

    /**label() overrides the default ones created */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('type')
                    ->options([
                        'cat' => 'Cat',
                        'dog' => 'Dog',
                        'rabbit' => 'Rabbit',
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
                //aqui van las columnas que quieres que aparezcan
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('date_of_birth')->sortable()->label('Fecha de Nacimiento'),
                Tables\Columns\TextColumn::make('owner.name')->searchable()->label('Dueño'),
            ])
            ->filters([
                //aqui van los filtros que quieras aplicar a la tabla
                /**Hay diferentes tipos de filtros ver docs */
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'cat' => 'Cat',
                        'dog' => 'Dog',
                        'rabbit' => 'Rabbit',
                    ])
            ])
            /**Pots cambiar les notificacions directamente en la accion
             * li afegeixes una notificacio directament
              */
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make()
                // ->successNotificationTitle('Paciente Eliminado'),
                ->successNotification(
                    Notification::make()
          ->success()
          ->title('Paciente eliminado')
          ->body('El paciente ha sido eliminado correctamente'),
                ),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //despues de crear un relationmanager se debe añadir aqui para que funcione
            RelationManagers\TreatmentsRelationManager::class,

        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([


                Section::make('Patient Info')
                    ->schema([
                        TextEntry::make('owner.name')->label('Owner'),
                        TextEntry::make('name')->label('Patient Name'),
                    ])->columns(2)
            ]);
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
            // 'view'=>Pages\ViewPatient::route('/{record}'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            TypeChart::class,
        ];
    }
}
