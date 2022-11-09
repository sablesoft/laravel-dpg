<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use App\Nova\Filters\CardsFilter;
use App\Nova\Filters\DecksFilter;
use App\Nova\Filters\OwnersFilter;
use App\Nova\Filters\ScopesFilter;
use App\Nova\Filters\IsPublicFilter;
use App\Nova\Filters\BooksFilter;

/**
 * @mixin \App\Models\Tag
 */
class Tag extends Content
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = \App\Models\Tag::class;

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
            BelongsTo::make(__('Scope'), 'scope', Tag::class)
                ->nullable(true)->sortable(true),
            Text::make(__('Decks'), 'decks_string')
                ->hideWhenCreating()->hideWhenUpdating()->asHtml(),
            Text::make(__('Books'), 'books_string')
                ->hideWhenCreating()->hideWhenUpdating()->asHtml(),
            Textarea::make(__('Desc'), 'desc')
                ->sortable()
                ->rules('max:255'),
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
                ->hideWhenCreating()->hideWhenUpdating()->sortable(true),
            HasMany::make(__('Scoped Tags'), 'nested', Tag::class)
                ->sortable()->nullable(true),
            HasMany::make(__('Scoped Cards'), 'scopedCards', Card::class)
                ->sortable()->nullable(true),
            HasMany::make(__('Scoped Decks'), 'scopedDecks', Deck::class)
                ->sortable()->nullable(true),
            HasMany::make(__('Scoped Books'), 'scopedBooks', Book::class)
                ->sortable()->nullable(true),
            BelongsToMany::make(__('Cards'), 'cards')
                ->sortable()->nullable(true),
            BelongsToMany::make(__('Decks'), 'decks')
                ->sortable()->nullable(true),
            BelongsToMany::make(__('Books'), 'books')
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
        return [
            new IsPublicFilter(),
            new OwnersFilter(),
            new ScopesFilter(),
            new BooksFilter(),
            new DecksFilter(),
            new CardsFilter(),
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
