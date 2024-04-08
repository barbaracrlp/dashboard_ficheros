<?php

namespace App\Filament\Panel2\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

use App\Models\Patient;
use App\Models\Team;
use App\Models\User;
use App\Models\Veterinary;
use Filament\Facades\Filament;

class StatsPanel2Overview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            //
            /** En teoria aqui estoy filtrando los usuarios y veterinarios segun du equipo, solo deben aparecer en las estadisticas
             * los que correspondan
            */
            Stat::make('Users',Team::find(Filament::getTenant())->first()->members->count())
            ->description('All users from this web')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->color('success'),
        Stat::make('Veterinary',Veterinary::query()->whereBelongsTo(Filament::getTenant())->count() )
            ->description('All Vets')
            ->descriptionIcon('heroicon-m-arrow-trending-down')
            ->color('danger'),
        Stat::make('Patients', Patient::query()->whereBelongsTo(Filament::getTenant())->count())
            ->description('Number of patients')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success'),
        ];
    }
}
