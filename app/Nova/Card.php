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
use App\Nova\Filters\DecksFilter;
use App\Nova\Filters\ScopesFilter;

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
            BelongsToMany::make(__('Deck'), 'deck', Card::class)
                ->fields(function () {
                    return [
                        Number::make(__('Count'), 'count')
                            ->nullable(false)->sortable()
                            ->required(true)
                            ->rules('required')
                            ->min(1)->step(1)->default(1),
                    ];
                })->sortable()->nullable(true),
            Number::make(__('Deck Size'), 'deck_size')
                ->nullable(true)->hideWhenCreating()->hideWhenUpdating(),
            BelongsTo::make(__('Scope'), 'scope', Tag::class)
                ->nullable(true)->sortable(),
            Textarea::make(__('Desc'), 'desc')
                ->nullable()->alwaysShow(),
            Text::make(__('Books'), 'books_string')
                ->onlyOnDetail()->asHtml(),
            Text::make(__('In Decks'), 'decks_string')
                ->hideWhenCreating()->hideWhenUpdating()->asHtml(),
            Text::make(__('Tags'), 'tags_string')
                ->hideWhenCreating()->hideWhenUpdating()->asHtml(),
            BelongsToMany::make(__('Books'), 'books', Book::class)
                ->sortable()->nullable(true),
            BelongsToMany::make(__('Tags'), 'tags', Tag::class)
                ->sortable()->nullable(true),
            BelongsToMany::make(__('In Decks'), 'decks', Card::class)
                ->sortable()->nullable(true),
            Boolean::make(__('Is Public'), 'is_public')
                ->hideFromIndex()
                ->nullable(false)->sortable(),
            BelongsTo::make(__('Owner'), 'owner', User::class)
                ->sortable()->hideFromIndex()
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
        return array_merge([
            new ScopesFilter(),
            new DecksFilter()
        ], parent::filters($request));
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
