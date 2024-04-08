<?php

namespace App\Filament\Resources\PatientResource\Pages;

use App\Filament\Resources\PatientResource;
use App\Filament\Resources\PatientResource\Widgets\TypeChart;
use Filament\Actions;



use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListPatients extends ListRecords
{
    protected static string $resource = PatientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
     public function getTabs():array
     {
        return[
            'All'=>Tab::make(),
            '+2 years'=>Tab::make()->modifyQueryUsing(fn(Builder $query)=>$query->where('date_of_birth','>=',now()->subYears(2)))
        ];
     }
    public function getFooterWidgets():array
    {
        return [
            TypeChart::class,
        ];
    }
}
