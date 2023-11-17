<?php

namespace Demo\Tmdb;

use Illuminate\Http\Request;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class Tmdb extends Tool
{
    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {
        Nova::script('tmdb', __DIR__ . '/../dist/js/tool.js');
        Nova::style('tmdb', __DIR__ . '/../dist/css/tool.css');
    }

    /**
     * Build the menu that renders the navigation links for the tool.
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function menu(Request $request)
    {
        return MenuSection::make('Popular Movies')
            ->path('/tmdb')
            ->icon('star');
    }
}
