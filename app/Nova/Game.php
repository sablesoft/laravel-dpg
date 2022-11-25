<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsToMany;

/**
 * @mixin \App\Models\Game
 */
class Game extends Resource
{
    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Personal';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = \App\Models\Game::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'prepared_name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
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
            Text::make(__('Name'), 'prepared_name')->sortable()
                ->nullable(true)->required(false)
                ->hideWhenCreating()->hideWhenUpdating(),
            BelongsTo::make(__('Book'), 'book', Book::class)
                ->sortable()->nullable(false)->required()
                ->rules('required')->hideWhenUpdating(),
            BelongsTo::make(__('Book'), 'book', Book::class)
                ->hideWhenCreating()->hideFromIndex()->hideFromDetail()
                ->readonly(),
            BelongsTo::make(__('Hero'), 'hero', Card::class)
                ->nullable(true)->sortable()->hideWhenCreating(),
            BelongsTo::make(__('Main Quest'), 'quest', Card::class)
                ->nullable(true)->sortable()->hideWhenCreating(),
            BelongsTo::make(__('Master'), 'master', User::class)
                ->sortable()->nullable(false)->required()
                ->rules('required')->hideWhenUpdating(),
            BelongsTo::make(__('Master'), 'master', User::class)
                ->hideWhenCreating()->hideFromIndex()->hideFromDetail()
                ->readonly(),
            Text::make(__('Name'), 'name')->sortable()
                ->nullable(true)->required(false)
                ->hideFromIndex()->hideFromDetail(),
            Textarea::make(__('Desc'), 'desc')->nullable(true)->alwaysShow(),
            Image::make(__('Board Image'), 'board_image')
                ->nullable(true)->hideFromIndex(),
            Boolean::make(__('Is Public'), 'is_public')
                ->nullable(false)->sortable(),

            // todo - make select:
//            Number::make(__('Status'), 'status'),

            HasMany::make(__('Uniques'), 'uniques'),
            HasMany::make(__('Stacks'), 'stacks'),
            HasMany::make(__('Sets'), 'sets'),
            HasMany::make(__('Logs'), 'logs', Log::class),
            BelongsToMany::make(__('Board'), 'board', Card::class),
            BelongsToMany::make(__('Players'), 'players', User::class),
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
