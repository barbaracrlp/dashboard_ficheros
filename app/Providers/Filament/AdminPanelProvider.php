<?php

namespace App\Providers\Filament;

use App\Http\Middleware\VerifyIsAdmin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

use Filament\Navigation\MenuItem;
class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {

        //para la autentificacion eliminar el default i el login i el authmiddleware

        return $panel
        ->default()
            ->id('admin')
            ->path('/panel2')
            // ->login()
            /**Añadimos el link al otro panel */
            ->userMenuItems([
                MenuItem::make()
                ->label('Admin')
                ->icon('heroicon-o-cog-6-tooth')
                ->url('/')
            ])
            ->colors([
                'primary' => Color::Blue,  
                'danger' => Color::Red,
                'info' => Color::Blue,
                'success' => Color::Emerald,
                'warning' => Color::Orange
            ])
            // ->font('Ubuntu')
            ->brandName('VetCare')
            // ->brandLogo(asset('images/logo.png'))
            ->favicon(asset('images/logo.png'))
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                // Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                VerifyIsAdmin::class,
            ]);
            // ->authMiddleware([
            //     Authenticate::class,
            // ]);
            /**en la relacio tens que posar el nom de la clase que has fet la relacion vamos */
            // ->tenant(Team::class,ownershipRelationship:'team',slugAttribute:'slug')
            // ->tenantRegistration(RegisterTeam::class)
            // ->tenantProfile(EditTeamProfile::class);
            /**aquí abajo debes poner el equipo 
             * aqui tambien se puede cambiar el nombre de la relacion 
             */
            // ->tenant(Team::class,ownershipRelationship:'team')
            // /**le dices que use la pagina de registro de tenants que has hecho */
            // ->tenantRegistration(RegisterTeam::class)
            // /**ahora tambien debe poder usar la pagina de edicion de los tenants */
            // ->tenantProfile(EditTeamProfile::class);
            
    }
}
