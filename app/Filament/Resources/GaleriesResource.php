<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GaleriesResource\Pages;
use App\Filament\Resources\GaleriesResource\RelationManagers;

use App\Models\Galery;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\ImageColumn;

class GaleriesResource extends Resource
{
    protected static ?string $model = Galery::class;

    protected static ?string $navigationIcon = 'heroicon-o-camera';

    protected static ?string $navigationGroup = "Images";

    protected static ?string $navigationLabel= 'Photo';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //cree el formulario de la galeria 
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
                    ->square(),
                // Tables\Columns\TextColumn::make('file_path')
                // ->label('file Path')
                // ->formatUsing(function ($value,$record) {
                //     return $record->file_path;
                // }),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGaleries::route('/'),
            'create' => Pages\CreateGaleries::route('/create'),
            'edit' => Pages\EditGaleries::route('/{record}/edit'),
        ];
    }
}
