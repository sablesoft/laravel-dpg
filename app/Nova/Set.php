<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use App\Models\Traits\Owner;
use App\Nova\Filters\ScopesFilter;
use App\Nova\Filters\TargetsFilter;

class Set extends Resource
{
    use Owner;

    public static $displayInNavigation = false;

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Play';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = \App\Models\Set::class;

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
        'id',
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
            BelongsTo::make(__('Game'), 'game', Game::class)
                ->readonly()->sortable(),
            BelongsTo::make(__('Target'), 'target', Card::class)
                ->readonly()->sortable(),
            BelongsTo::make(__('Scope'), 'scope', Card::class)
                ->readonly()->sortable(),
            Textarea::make(__('Desc'), 'desc')->alwaysShow(),
            Text::make(__('Cards'), 'cards_string')->asHtml()
                ->hideWhenCreating()->hideWhenUpdating(),
            BelongsToMany::make(__('Cards'), 'cards', Card::class)
                ->fields(function () {
                    return [
                        Number::make(__('Level'), 'level')
                            ->nullable(false)->sortable()
                            ->required(true)
                            ->rules('required')
                            ->min(0)->step(1)->default(0),
                        Number::make(__('Points'), 'points')
                            ->nullable(false)->sortable()
                            ->required(true)
                            ->rules('required')
                            ->min(0)->step(1)->default(0),
                    ];
                })->sortable()->nullable(true),
            DateTime::make(__('Created At'), 'created_at')
                ->hideFromIndex()
                ->hideWhenCreating()->hideWhenUpdating()->sortable(true),
            DateTime::make(__('Updated At'), 'updated_at')
                ->hideFromIndex()
                ->hideWhenCreating()->hideWhenUpdating()->sortable(true),
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
        return [
            TargetsFilter::make(),
            ScopesFilter::make()
        ];
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
