<?php

namespace App\Filament\Widgets;

use App\Models\Patient;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestPatients extends BaseWidget
{

    protected static ?int $sort=6;

    protected static ?string $heading = 'Patients';

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(Patient::query())
            ->defaultSort('created_at','desc')
            ->columns([
                // ...
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('date_of_birth')->label('Fecha de Nacimiento'),

            ]);
    }
}
