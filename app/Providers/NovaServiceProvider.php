<?php

namespace App\Providers;

use App\Nova\Dashboards\Main;
use App\Nova\Director;
use App\Nova\Genre;
use App\Nova\Studio;
use App\Nova\User;
use Demo\Tmdb\Tmdb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        Nova::withBreadcrumbs();
        Nova::initialPath('/resources/movies');

        $this->customMenu();
    }

    private function customMenu()
    {
        Nova::mainMenu(function (Request $request) {
            return [
                MenuSection::make('Movies', [
                    MenuItem::make('All Movies', '/resources/movies'),
                    MenuItem::make('Add Movie', '/resources/movies/new'),
                ])->icon('film')->collapsable(),

                MenuSection::resource(Genre::class)
                    ->icon('tag'),

                MenuSection::resource(Studio::class)
                    ->icon('globe-alt'),

                MenuSection::resource(Director::class)
                    ->icon('video-camera'),

                (new Tmdb())->menu($request),

                MenuSection::resource(User::class)
                    ->icon('user-group'),
            ];
        });
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new \App\Nova\Dashboards\Main(),
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            new Tmdb(),
        ];
    }
}
