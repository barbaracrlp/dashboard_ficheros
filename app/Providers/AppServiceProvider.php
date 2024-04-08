<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

use Filament\Support\Facades\FilamentIcon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //aqui quito la sobreproteccion de los att ya que filament valida solo
        Model::unguard();

        /**Aqui es donde en teoria se le puede cambiar el iconos
         * importamos la clase primero 
         */

        //  FilamentIcon::register([
        //     'panels::pages.dashboard.navigation-item' => 'heroicon-o-beaker',
            
        // ]);
    }
}
