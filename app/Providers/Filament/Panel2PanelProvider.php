<?php

namespace App\Providers\Filament;

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

use App\Filament\Panel2\Pages\Tenancy\EditTeamProfile;
use App\Filament\Panel2\Pages\Tenancy\RegisterTeam;
use App\Models\Team;
use Filament\Navigation\MenuItem;
use PhpParser\Node\Stmt\Label;

use App\Models\User;

class Panel2PanelProvider extends PanelProvider
{
 

    protected static ?string $navigationLabel = 'Photos';
    
    public function panel(Panel $panel): Panel
    {
        /**Para registrar nuevos usuarios 
         * añadir el metodo register 
         * añadimos tasmbien un link para poder cambiar de paneles 
         * usermenuitems()
         * profile() lleva a la identificacion del perfil
         * como hacer que el link al admin sea solo para admin 
         * -visible() el metodo esAdmin se tiene que realizar en user
         * se crea bien,funciona pero no me coje como que está definido 
         */
        return $panel
            ->id('panel2')
            ->path('/')
            ->login()
            ->registration()
            ->profile()
            // ->collapsibleNavigationGroups()
            ->userMenuItems([
                MenuItem::make()
                ->label('panel2')
                ->icon('heroicon-o-cog-6-tooth')
                ->url('/panel2')
                /**esta es la funcion que utilizo para ver si el usuario tiene permisos
                 * para ver o no, es visible el menuitem
                 * ahora hay un booleano en el modelo de user no hace falta crear una funcion aposta como antes
                 */
                ->visible(fn():bool=>auth()->user()->is_admin)
            ])
            ->colors([
                'primary' => Color::Emerald,
                'danger' => Color::Red,
                'info' => Color::Blue,
                'success' => Color::Emerald,
                'warning' => Color::Orange
            ])
            ->brandName('VetCare')
            ->favicon(asset('images/logo.png'))
            ->discoverResources(in: app_path('Filament/Panel2/Resources'), for: 'App\\Filament\\Panel2\\Resources')
            ->discoverPages(in: app_path('Filament/Panel2/Pages'), for: 'App\\Filament\\Panel2\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Panel2/Widgets'), for: 'App\\Filament\\Panel2\\Widgets')
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
            ])
            ->authMiddleware([
                Authenticate::class,
            ])->tenant(Team::class,ownershipRelationship:'team',slugAttribute:'slug')
            ->tenantRegistration(RegisterTeam::class)
            ->tenantProfile(EditTeamProfile::class);
    }
}
