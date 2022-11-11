<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use App\Nova\Filters\CardsFilter;
use App\Nova\Filters\IsPublicFilter;

/**
 * @mixin \App\Models\Book
 */
class Book extends Content
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = \App\Models\Book::class;

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
            Number::make(__('Unique Cards'), 'cards_count')
                ->hideWhenUpdating()->hideWhenCreating(),
            BelongsTo::make(__('Scope'), 'scope', Tag::class)
                ->nullable(true)->sortable()->hideFromIndex(),
            BelongsTo::make(__('Hero'), 'hero', Card::class)
                ->nullable(true),
            BelongsTo::make(__('Main Quest'), 'quest', Card::class)
                ->nullable(true),
            Text::make(__('Tags'), 'tags_string')
                ->hideFromIndex()->hideWhenCreating()->hideWhenUpdating()->asHtml(),
            Textarea::make(__('Desc'), 'desc')->nullable(),
            BelongsToMany::make(__('Tags'), 'tags', Tag::class)
                ->sortable()->nullable(true),
            BelongsToMany::make(__('Cards'), 'cards', Card::class)
                ->sortable()->nullable(true),
            Boolean::make(__('Is Public'), 'is_public')
                ->nullable(false)->sortable(),
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
            new IsPublicFilter(),
            new CardsFilter()
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
