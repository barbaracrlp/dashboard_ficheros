<?php

namespace App\Filament\Panel2\Resources;

use App\Filament\Panel2\Resources\VeterinaryResource\Pages;
use App\Filament\Panel2\Resources\VeterinaryResource\RelationManagers;
use App\Models\Veterinary;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;

class VeterinaryResource extends Resource
{
    protected static ?string $model = Veterinary::class;

    // protected static ?string $navigationIcon = 'heroicon-o-identification';
    protected static ?string $navigationIcon =null;

    protected static ?string $title = 'Vets';

    protected static ?string $navigationGroup="Clinic";

    
    /**intento crear una badge pero que solo me diga los del equipo */
    public static function getNavigationBadge(): ?string
    {
        $tenant=Filament::getTenant();

        $patientCount= Veterinary::query()->where('team_id',$tenant->getKey())->count();

        return $patientCount>0? (string)$patientCount: null;
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //copiamos el mismo formulario que ya estaba en el recurso del otro panel
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('date_hiring')
                    ->label('Comienzo')
                    ->native(false)
                    ->displayFormat('d/m/Y')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //tambien copiamos la table del recurso original 
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_hiring')
                    ->date()

                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
        ->schema([
            Section::make('Veterinary Info')
            ->schema([
                TextEntry::make(('name')),
                TextEntry::make(('date_hiring'))
                ->dateTime(),

            ])
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
            'index' => Pages\ListVeterinaries::route('/'),
            'create' => Pages\CreateVeterinary::route('/create'),
            'view' => Pages\ViewVeterinary::route('/{record}'),
            'edit' => Pages\EditVeterinary::route('/{record}/edit'),
        ];
    }
}
