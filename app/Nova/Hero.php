<?php

namespace App\Nova;

use App\Service\ImageService;
use Illuminate\Database\Eloquent\Builder;
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
use Laravel\Nova\Http\Requests\NovaRequest;

class Hero extends Card
{
    /**
     * @return string
     */
    public static function uriKey(): string
    {
        return 'heroes';
    }

    /**
     * @param NovaRequest $request
     * @param $query
     * @return Builder
     * @throws \Exception
     */
    public static function indexQuery(NovaRequest $request, $query): Builder
    {
        if (!$hero = \App\Models\Card::getCardByCode('hero')) {
            throw new \Exception('Hero card not found!');
        }
        $query->where('scope_id', $hero->getKey());
        /** @var \App\Models\User $user */
        $user = $request->user();
        if (!$user->isAdmin()) {
            $query->where(function ($query) use ($user) {
                $query->where('is_public', '=', true)
                    ->orWhere('owner_id', '=', $user->getKey());
                return static::isBookSubscriber($query, $user);
            });
        }

        return $query;
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
                ->store(function (Request $request, $model, $attribute, $requestAttribute) {
                    return ImageService::uploadCardImage($request->file($requestAttribute));
                })->disk(ImageService::diskName())->nullable(true)->prunable(),
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
            HasMany::make(__('Scoped Cards'), 'scopedCards', Card::class)
                ->sortable()->nullable(true),
            HasMany::make(__('Scoped Decks'), 'scopedDecks', Deck::class)
                ->sortable()->nullable(true),
            BelongsToMany::make(__('Tags'), 'tags', Card::class)
                ->sortable()->nullable(true),
            HasMany::make(__('Tagged Cards'), 'taggedCards', Card::class)
                ->sortable()->nullable(true),
            BelongsToMany::make(__('In Decks'), 'inDecks', Deck::class)
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
            Boolean::make(__('Is Public'), 'is_public')
                ->nullable(false)->sortable(),
            BelongsTo::make(__('Owner'), 'owner', User::class)
                ->sortable()->hideWhenUpdating()->hideWhenCreating(),
            DateTime::make(__('Created At'), 'created_at')
                ->hideFromIndex()
                ->hideWhenCreating()->hideWhenUpdating()->sortable(true),
            DateTime::make(__('Updated At'), 'updated_at')
                ->hideFromIndex()
                ->hideWhenCreating()->hideWhenUpdating()->sortable(true)
        ];
    }
}
