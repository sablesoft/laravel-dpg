<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsToMany;

/**
 * @mixin \App\Models\Deck
 */
class Deck extends Content
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = \App\Models\Deck::class;

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
                ->nullable(false)->required()
                ->sortable()->rules('required', 'max:30'),
            Image::make(__('Image'), 'image')
                ->nullable(true)->hideFromIndex(),
            Text::make(__('Adventures'), 'adventures_string')
                ->hideWhenCreating()->hideWhenUpdating()->asHtml(),
            Text::make(__('Tags'), 'tags_string')
                ->hideWhenCreating()->hideWhenUpdating()->asHtml(),
            Textarea::make(__('Desc'), 'desc')
                ->nullable()->rules('max:255'),
            BelongsTo::make(__('Owner'), 'owner', User::class)
                ->sortable()
                ->hideWhenUpdating()->hideWhenCreating(),
            BelongsToMany::make(__('Cards'), 'cards')
                ->fields(function () {
                    return [
                        Number::make(__('Count'), 'count')
                            ->required(true)
                            ->nullable(false)
                            ->rules('required')
                            ->min(1)->step(1)->default(1),
                    ];
                })->sortable()->nullable(true),
            BelongsToMany::make(__('Adventures'), 'adventures')
                ->sortable()->nullable(true),
            BelongsToMany::make(__('Tags'), 'tags')
                ->sortable()->nullable(true),
            DateTime::make(__('Created At'), 'created_at')
                ->hideFromIndex()
                ->hideWhenCreating()->hideWhenUpdating()->sortable(true),
            DateTime::make(__('Updated At'), 'updated_at')
                ->hideFromIndex()
                ->hideWhenCreating()->hideWhenUpdating()->sortable(true)
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
        return parent::filters($request);
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
