<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GaleriaMultipleResource\Pages;
use App\Filament\Resources\GaleriaMultipleResource\RelationManagers;
use App\Models\GaleriaMultiple;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GaleriaMultipleResource extends Resource
{
    protected static ?string $model = GaleriaMultiple::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = "Images";

    protected static ?string $navigationLabel= 'Galleries';

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
                    ->square()
                    ->stacked()
                    ->visibility('private'),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListGaleriaMultiples::route('/'),
            'create' => Pages\CreateGaleriaMultiple::route('/create'),
            'edit' => Pages\EditGaleriaMultiple::route('/{record}/edit'),
        ];
    }
}
