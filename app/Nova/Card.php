<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use App\Nova\Filters\ScopesFiler;

/**
 * @mixin \App\Models\Card
 */
class Card extends Content
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = \App\Models\Card::class;

    /**
     * @return string
     */
    public static function uriKey(): string
    {
        return 'units';
    }

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
            BelongsTo::make(__('Scope'), 'scope')->nullable(true)->sortable(),
            Textarea::make(__('Desc'), 'desc')
                ->nullable()->alwaysShow(),
            Textarea::make(__('Private Desc'), 'private_desc')
                ->nullable()->rules('max:255'),
            Text::make(__('Tags'), 'tags_string')
                ->hideWhenCreating()->hideWhenUpdating()->asHtml(),
            Text::make(__('Decks'), 'decks_string')
                ->hideWhenCreating()->hideWhenUpdating()->asHtml(),
            BelongsToMany::make(__('Tags'), 'tags')->sortable()->nullable(true),
            BelongsToMany::make(__('Decks'), 'decks')
                ->sortable()->nullable(true),
            BelongsTo::make(__('Owner'), 'owner', User::class)
                ->sortable()
                ->hideWhenUpdating()->hideWhenCreating(),
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
        return array_merge(parent::filters($request), [
            new ScopesFiler()
        ]);
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
