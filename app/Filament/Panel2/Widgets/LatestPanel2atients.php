<?php

namespace App\Filament\Panel2\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

use App\Models\Patient;
use Filament\Facades\Filament;

class LatestPanel2atients extends BaseWidget
{

    protected static ?int $sort=3;

    protected static ?string $heading = 'Patients';

    // protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(Patient::query()->whereBelongsTo(Filament::getTenant()))
            ->defaultSort('created_at','desc')
            ->columns([
                // ...
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('date_of_birth')->label('Fecha de Nacimiento'),

            ]);
    }
}
