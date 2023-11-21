<?php

namespace App\Nova;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Customer extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Customer>
     */
    public static $model = \App\Models\Customer::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'first_name', 'last_name'
    ];

    public function title()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('First Name')
                ->rules('string')
                ->creationRules('required')
                ->updateRules('nullable')
                ->sortable(),

            Text::make('Middle Name')
                ->help('Leave blank if not applicable')
                ->nullable()
                ->sortable(),

            Text::make('Last Name')
                ->rules('string')
                ->creationRules('required')
                ->updateRules('nullable')
                ->sortable(),

            Image::make('Valid ID')
                ->path('customers')
                ->nullable(),

            Boolean::make('Is Verified')
                ->filterable(),

            HasMany::make('Rentals')
                ->sortable(),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [
            Action::using('Verify', function (ActionFields $fields, Collection $models) {
                \App\Models\Customer::whereKey($models->pluck('id'))
                    ->where('is_verified', false)
                    ->update([
                        'is_verified' => true,
                    ]);
            })->withoutConfirmation()
                ->onlyOnDetail(),

            Action::using('Unverify', function (ActionFields $fields, Collection $models) {
                \App\Models\Customer::whereKey($models->pluck('id'))
                    ->where('is_verified', true)
                    ->update([
                        'is_verified' => false,
                    ]);
            })->onlyOnDetail(),
        ];
    }
}
