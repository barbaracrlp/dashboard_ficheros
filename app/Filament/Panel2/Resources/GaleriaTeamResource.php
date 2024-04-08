<?php

namespace App\Filament\Panel2\Resources;

use App\Filament\Panel2\Resources\GaleriaTeamResource\Pages;
use App\Filament\Panel2\Resources\GaleriaTeamResource\RelationManagers;
use App\Models\GaleriaTeam;
use App\Models\Galery;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
// use Filament\Forms\Components\Section;

use Filament\Infolists\Components\Section;
use Filament\Forms\Form;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GaleriaTeamResource extends Resource
{
    protected static ?string $model = Galery::class;

    protected static ?string $navigationIcon = 'heroicon-o-camera';
      // Establece el título de navegación
      protected static ?string $navigationLabel = 'Photos';

      protected static ?string $navigationGroup = "Images";
      protected static ?string $title = 'Photos';


    
    /**intento crear una badge pero que solo me diga los del equipo */
    public static function getNavigationBadge(): ?string
    {
        $tenant=Filament::getTenant();

        $patientCount= Galery::query()->where('team_id',$tenant->getKey())->count();

        return $patientCount>0? (string)$patientCount: null;
    }
    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('description'),
            FileUpload::make('file_path'),
        ]);
          
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('description'),
                ImageColumn::make('file_path')
    ->square()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
                Section::make('Patient Info')
                    ->schema([
                        TextEntry::make('name')->label('Nombre'),
                        TextEntry::make('description')->label('Descripción de la galeria'),
                        // ImageEntry::make('file_path')->label('Archivo')
                    ])->columns(2),
                    Section::make('Imágenes')
                    ->schema([
                        ImageEntry::make('file_path')->label('Archivo')
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
            'index' => Pages\ListGaleriaTeams::route('/'),
            'create' => Pages\CreateGaleriaTeam::route('/create'),
            'edit' => Pages\EditGaleriaTeam::route('/{record}/edit'),
        ];
    }
}
