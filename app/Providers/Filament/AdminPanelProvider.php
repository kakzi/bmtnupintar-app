<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use App\Models\User;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Pages\Dashboard;
use Filament\Support\Colors\Color;
use Filament\Navigation\NavigationItem;
use App\Filament\Resources\UserResource;
use Filament\Navigation\NavigationGroup;
use App\Filament\Resources\QuoteResource;
use App\Filament\Resources\AuthorResource;
use App\Filament\Resources\CareerResource;
use App\Filament\Resources\OfficeResource;
use Filament\Http\Middleware\Authenticate;
use Filament\Navigation\NavigationBuilder;
use App\Filament\Resources\CategoryResource;
use App\Filament\Resources\BannerAdsResource;
use App\Filament\Resources\ArticleNewsResource;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use App\Filament\Resources\JenisPembiayaanResource;
use App\Filament\Resources\PeriodeAngsuranResource;
use Illuminate\Routing\Middleware\SubstituteBindings;
use App\Filament\Resources\KeyIndicatorTellerResource;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Althinect\FilamentSpatieRolesPermissions\FilamentSpatieRolesPermissionsPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {

        // $user = User::find(1);
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Emerald,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                \Hasnayeen\Themes\Http\Middleware\SetTheme::class,
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
            ->tenantMiddleware([
                
                \Hasnayeen\Themes\Http\Middleware\SetTheme::class
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugin(
                \Hasnayeen\Themes\ThemesPlugin::make()
                    // ->canViewThemesPage(fn () => $user)
            )
            
            ->plugin(FilamentSpatieRolesPermissionsPlugin::make())
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                return $builder->groups([

                    NavigationGroup::make('')
                        ->items([
                            NavigationItem::make('Dashboard')
                            ->label(fn (): string => __('filament-panels::pages/dashboard.title'))
                            ->icon('heroicon-o-home')
                            ->url(fn (): string => Dashboard::getUrl())
                            ->isActiveWhen(fn () => request()->routeIs('filament.admin.pages.dashboard')),
                        ]),
                    NavigationGroup::make('Data Master')
                        ->items([
                            ...UserResource::getNavigationItems(),
                            ...CareerResource::getNavigationItems(),
                            ...OfficeResource::getNavigationItems(),
                            ...PeriodeAngsuranResource::getNavigationItems(),
                            ...JenisPembiayaanResource::getNavigationItems(),
                            ...QuoteResource::getNavigationItems(),
                        ]),
                    NavigationGroup::make('KPI Santri')
                        ->items([
                            ...KeyIndicatorTellerResource::getNavigationItems(),
                        ]),
                    NavigationGroup::make('Blok NU')
                        ->items([
                            ...CategoryResource::getNavigationItems(),
                            ...AuthorResource::getNavigationItems(),
                            ...BannerAdsResource::getNavigationItems(),
                            ...ArticleNewsResource::getNavigationItems(),
                        ]),
                    NavigationGroup::make('Role and Permissions')
                        ->items([
                            NavigationItem::make('Roles')
                                ->label('Roles')
                                ->icon('heroicon-o-user-group')
                                ->isActiveWhen(fn (): bool => request()
                                    ->routeIs([
                                        'filament.admin.resources.roles.index',
                                        'filament.admin.resources.roles.edit',
                                        'filament.admin.resources.roles.create',
                                        'filament.admin.resources.roles.view',
                                    ]))
                                ->url(fn() : string => '/admin/roles'),
                                // ->visible(fn (): bool => auth()->user()->can('roles')),
                            NavigationItem::make('Permission')
                                ->label('Permission')
                                ->icon('heroicon-o-lock-closed')
                                ->isActiveWhen(fn (): bool => request()
                                    ->routeIs([
                                        'filament.admin.resources.permissions.index',
                                        'filament.admin.resources.permissions.edit',
                                        'filament.admin.resources.permissions.create',
                                        'filament.admin.resources.permissions.view',
                                    ]))
                                ->url(fn() : string => '/admin/permissions'),
                                // ->visible(fn (): bool => auth()->user()->can('permissions')),
                        ]),
                ]);
            });
            
            ;
    }
}
