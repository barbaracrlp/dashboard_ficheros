<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AccesoriosResource\Pages;
use App\Filament\Resources\AccesoriosResource\RelationManagers;
use App\Models\Accesorios;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AccesoriosResource extends Resource
{
    protected static ?string $model = Accesorios::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    //puedes cabiar las laels i el icono el ? indica que no es required

    protected static ?string $navigationLabel= 'Shop';

    protected static ?string $modelLabel= 'Accesories Shop';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //aqui se agregan las partes del formulario correspondiendo con la migracion de la tabla
                Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
                Forms\Components\Textarea::make('description')
                ->required(),
                Forms\Components\TextInput::make('price')
                ->numeric()
                ->prefix('€')
                ->maxValue(1000000000),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //aqui se agregan las columnas segun lo que quieras que aparezca y segun 
                //las columnas de la DB
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('price')
                ->money('EUR')
                ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageAccesorios::route('/'),
        ];
    }
}
