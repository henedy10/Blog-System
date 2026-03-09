<?php

namespace App\Providers\Filament;

use App\Filament\Widgets\StatsOverview;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Filament\Pages\MyProfile;
use Filament\Http\Middleware\
{
    Authenticate,
    AuthenticateSession,
    DisableBladeIconComponents,
    DispatchServingFilamentEvent
};
use Illuminate\Cookie\Middleware\
{
    AddQueuedCookiesToResponse,
    EncryptCookies
};
use Filament\Enums\
{
    UserMenuPosition,
    ThemeMode
};

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->profile(MyProfile::class,isSimple: false)
            ->brandName('Blog System')
            ->colors(['primary' => Color::Red])
            ->globalSearch(false)
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                StatsOverview::class
            ])
            ->defaultThemeMode(ThemeMode::Light)
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
            ])
            ;
    }
}
