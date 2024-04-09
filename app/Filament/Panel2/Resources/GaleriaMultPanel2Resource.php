<?php

namespace App\Filament\Panel2\Resources;

use App\Filament\Panel2\Resources\GaleriaMultPanel2Resource\Pages;
use App\Filament\Panel2\Resources\GaleriaMultPanel2Resource\RelationManagers;
use App\Models\GaleriaMultiple;
use App\Models\GaleriaMultPanel2;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GaleriaMultPanel2Resource extends Resource
{
    protected static ?string $model = GaleriaMultiple::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = "Images";

    protected static ?string $navigationLabel= 'Galleries';

    protected static ?string $title = 'Gallery';

    
    /**intento crear una badge pero que solo me diga los del equipo */
    public static function getNavigationBadge(): ?string
    {
        $tenant=Filament::getTenant();

        $patientCount= GaleriaMultiple::query()->where('team_id',$tenant->getKey())->count();

        return $patientCount>0? (string)$patientCount: null;
    }






    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //creo el formulario de la galeria multiple
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(120),
                Forms\Components\TextInput::make('description')
                    ->maxLength(500),
                FileUpload::make('files')
                    ->multiple()
                    ->visibility('private'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                 //en las columnas si tengo varias fotos deberia poder usar el stack metodo
                 Tables\Columns\TextColumn::make('name')->searchable(),
                 Tables\Columns\TextColumn::make('description'),
                 ImageColumn::make('files')
                     ->circular()
                     ->stacked()
                     ->visibility('private'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                     
                ]),
            ]);
    }

// /**intento de hacer la infolist en multiple */
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
                          RepeatableEntry::make('files')
                          ->schema([
                            ImageEntry::make('file_path')
                        ])
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
            'index' => Pages\ListGaleriaMultPanel2s::route('/'),
            'create' => Pages\CreateGaleriaMultPanel2::route('/create'),
            'edit' => Pages\EditGaleriaMultPanel2::route('/{record}/edit'),
        ];
    }
}
/**aqui hago el tercero comentario/cambio para
 * poder realizar el tercero comit en git 
 */