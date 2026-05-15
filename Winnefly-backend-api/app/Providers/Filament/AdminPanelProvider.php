<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;


class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->brandName('Winnefly Pastries')
            ->darkMode(false)
            ->colors([
                'primary' => [
                    50 => '253, 248, 240',
                    100 => '244, 231, 216',
                    200 => '216, 195, 165',
                    300 => '197, 140, 109',
                    400 => '139, 107, 97',
                    500 => '74, 46, 43',
                    600 => '62, 37, 35',
                    700 => '55, 33, 31',
                    800 => '47, 30, 27',
                    900 => '59, 38, 36',
                    950 => '33, 20, 18',
                ],

                'info' => [
                    50 => '217, 232, 234',
                    100 => '190, 220, 228',
                    200 => '158, 188, 219',
                    300 => '120, 160, 199',
                    400 => '78, 139, 183',
                    500 => '62, 116, 154',
                    600 => '54, 82, 93',
                    700 => '43, 65, 74',
                    800 => '33, 49, 56',
                    900 => '22, 33, 38',
                    950 => '12, 20, 24',
                ],
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
