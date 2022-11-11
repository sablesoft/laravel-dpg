<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use App\Nova\Filters\BooksFilter;
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
            BelongsTo::make(__('Scope'), 'scope', Tag::class)
                ->nullable(true)->sortable(),
            Textarea::make(__('Desc'), 'desc')
                ->nullable()->alwaysShow(),
            Text::make(__('Books'), 'books_string')
                ->onlyOnDetail()->asHtml(),
            Number::make(__('Decks Count'), 'decks_count')
                ->hideWhenCreating()->hideWhenUpdating(),
            Text::make(__('Tags'), 'tags_string')
                ->hideWhenCreating()->hideWhenUpdating()->asHtml(),
            HasMany::make(__('Decks'), 'decks', Deck::class)
                ->sortable()->nullable(true),
            BelongsToMany::make(__('In Decks'), 'inDecks', Card::class)
                ->fields(function () {
                    return [
                        Number::make(__('Count'), 'count')
                            ->nullable(false)->sortable()
                            ->required(true)
                            ->rules('required')
                            ->min(1)->step(1)->default(1),
                    ];
                })->sortable()->nullable(true),
            BelongsToMany::make(__('Books'), 'books', Book::class)
                ->sortable()->nullable(true),
            BelongsToMany::make(__('Tags'), 'tags', Tag::class)
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
            new DecksFilter(),
            new BooksFilter()
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
