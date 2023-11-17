<?php

namespace App\Nova;

use App\Nova\Metrics\MoviesPerGenre;
use App\Nova\Metrics\MoviesPerStudio;
use App\Nova\Metrics\NewMovies;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\FormData;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Movie extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Movie>
     */
    public static $model = \App\Models\Movie::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'title',
        'director.name',
        'studio.company_name',
    ];

    public function title()
    {
        return $this->title . ' (' . $this->year . ')';
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Image::make('Poster')
                ->path('posters')
                ->creationRules('required')
                ->updateRules('nullable'),

            Text::make('Title')
                ->sortable()
                ->rules('required'),

            BelongsTo::make('Genre')
                ->relatableQueryUsing(function (NovaRequest $request, Builder $query) {
                    $query->whereNull('parent_id');
                })
                ->showCreateRelationButton()
                ->modalSize('3xl')
                ->rules('required', Rule::exists('genres', 'id')->whereNull('parent_id')),

            BelongsTo::make('Sub-Genre', 'subGenre', resource: Genre::class)
                ->dependsOn(['genre'], function (BelongsTo $field, NovaRequest $request, FormData $data) {
                    if ($data->genre === null) {
                        $field->hide();
                    }

                    $field
                        ->relatableQueryUsing(function (NovaRequest $request, Builder $query) use ($data) {
                            $query->where('parent_id', $data->genre);
                        })
                        ->showCreateRelationButton()
                        ->modalSize('3xl')
                        ->rules('required', Rule::exists('genres', 'id')->where('parent_id', $data->genre));
                }),

            BelongsTo::make('Director')
                ->showCreateRelationButton()
                ->modalSize('3xl')
                ->searchable()
                ->sortable(),

            BelongsTo::make('Film Studio', 'studio', Studio::class)
                ->showCreateRelationButton()
                ->modalSize('3xl')
                ->hideFromIndex()
                ->searchable()
                ->filterable(),

            Number::make('Year')
                ->sortable()
                ->filterable()
                ->rules('integer', 'required', 'digits:4'),

            Markdown::make('Description')
                ->hideFromIndex(),

            Number::make('Rating', 'rating_out_of_five')
                ->sortable()
                ->filterable()
                ->min(1)
                ->max(5)
                ->rules('min:1', 'max:5', 'integer', 'required')
                ->help('IMDb Rating from 1 to 5'),

            Boolean::make('Is Featured')
                ->filterable(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [
            new NewMovies(),
            new MoviesPerGenre(),
            new MoviesPerStudio(),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [
            Action::using('Feature', function (ActionFields $fields, Collection $models) {
                \App\Models\Movie::whereKey($models->pluck('id'))
                    ->where('is_featured', false)
                    ->update([
                        'is_featured' => true,
                    ]);
            })->withoutConfirmation(),
            Action::using('Unfeature', function (ActionFields $fields, Collection $models) {
                \App\Models\Movie::whereKey($models->pluck('id'))
                    ->where('is_featured', true)
                    ->update([
                        'is_featured' => false,
                    ]);
            }),
        ];
    }

    public function subtitle()
    {
        return $this->director->name;
    }
}
