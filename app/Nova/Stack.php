<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Number;
use App\Nova\Actions\PullCard;
use App\Nova\Actions\InitStack;
use App\Nova\Filters\GamesFilter;
use App\Nova\Actions\ShuffleStack;
use App\Nova\Filters\ScopesFilter;
use App\Nova\Filters\TargetsFilter;

class Stack extends Resource
{
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
    public static string $model = \App\Models\Stack::class;

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
            BelongsTo::make(__('Game'), 'game')
                ->sortable()->nullable(false)->required()->rules('required'),
            BelongsTo::make(__('Target'), 'target', Card::class)
                ->nullable(false)->sortable()
                ->required()->rules('required'),
            BelongsTo::make(__('Scope'), 'scope', Card::class)
                ->nullable(false)->sortable()
                ->required()->rules('required'),
            Number::make(__('Pack Size'), 'pack_size')
                ->hideWhenCreating()->hideWhenUpdating(),
//            Code::make(__('Pack'), 'pack')->json()->onlyOnDetail(),
            Number::make(__('Discard Size'), 'discard_size')
                ->hideWhenCreating()->hideWhenUpdating(),
//            Code::make(__('Discard'), 'discard')->json()->onlyOnDetail(),
            DateTime::make(__('Created At'), 'created_at')
                ->hideFromIndex()
                ->hideWhenCreating()->hideWhenUpdating()->sortable(true),
            DateTime::make(__('Updated At'), 'updated_at')
                ->hideFromIndex()
                ->hideWhenCreating()->hideWhenUpdating()->sortable(true),
            HasMany::make(__('Logs'), 'logs', Log::class)
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
            GamesFilter::make(),
            TargetsFilter::make(),
            ScopesFilter::make(),
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
        return [
            InitStack::make()->showOnTableRow(),
            ShuffleStack::make()->showOnTableRow(),
            PullCard::make()->showOnTableRow()
        ];
    }
}
