<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\BelongsTo;

/**
 * @mixin \App\Models\Scope
 */
class Scope extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = \App\Models\Scope::class;

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
            Textarea::make(__('Desc'), 'desc')
                ->sortable()
                ->rules('max:255'),
            BelongsTo::make(__('Owner'), 'owner', User::class)
                ->sortable()
                ->hideWhenUpdating()->hideWhenCreating(),
            DateTime::make(__('Created At'), 'created_at')
                ->hideWhenCreating()->hideWhenUpdating()->sortable(true),
            DateTime::make(__('Updated At'), 'updated_at')
                ->hideWhenCreating()->hideWhenUpdating()->sortable(true),
            HasMany::make(__('Tags'), 'tags')->sortable(),
            HasMany::make(__('Cards'), 'cards')->sortable()
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
