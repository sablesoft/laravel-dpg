<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

/**
 * @mixin \App\Models\Tag
 */
class Tag extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = \App\Models\Tag::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param Request $request
     * @return array
     */
    public function fields(Request $request): array
    {
        return [
            Text::make(__('Name'), 'name')
                ->sortable()
                ->rules('required', 'max:255'),
            Image::make(__('Image'), 'image')->nullable(true),
            BelongsTo::make(__('Scope'), 'scope')
                ->nullable(true)->sortable(true),
            Text::make(__('Decks'), 'decks_string')
                ->hideWhenCreating()->hideWhenUpdating()->asHtml(),
            Text::make(__('Adventures'), 'adventures_string')
                ->hideWhenCreating()->hideWhenUpdating()->asHtml(),
            Textarea::make(__('Desc'), 'desc')
                ->sortable()
                ->rules('max:255'),
            BelongsTo::make(__('Owner'), 'owner', User::class)
                ->sortable()
                ->hideWhenUpdating()->hideWhenCreating(),
            DateTime::make(__('Created At'), 'created_at')
                ->hideFromIndex()
                ->hideWhenCreating()->hideWhenUpdating()->sortable(true),
            DateTime::make(__('Updated At'), 'updated_at')
                ->hideFromIndex()
                ->hideWhenCreating()->hideWhenUpdating()->sortable(true),
            BelongsToMany::make(__('Cards'), 'cards')
                ->sortable()->nullable(true),
            BelongsToMany::make(__('Decks'), 'decks')
                ->sortable()->nullable(true),
            BelongsToMany::make(__('Adventures'), 'adventures')
                ->sortable()->nullable(true),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param Request $request
     * @return array
     */
    public function cards(Request $request): array
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param Request $request
     * @return array
     */
    public function filters(Request $request): array
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param Request $request
     * @return array
     */
    public function lenses(Request $request): array
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param Request $request
     * @return array
     */
    public function actions(Request $request): array
    {
        return [];
    }
}
