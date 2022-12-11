<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
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
use App\Service\ImageService;
use App\Nova\Actions\CopyCard;
use App\Nova\Filters\BooksFilter;
use App\Nova\Filters\ImageFilter;
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
     * @param NovaRequest $request
     * @param $query
     * @return Builder
     */
    public static function indexQuery(NovaRequest $request, $query): Builder
    {
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
     * @param Builder $query
     * @param \App\Models\User $user
     * @return Builder
     */
    protected static function isBookSubscriber(Builder $query, \App\Models\User $user): Builder
    {
        return $query->orWhere(function($query) use ($user) {
            return $query->whereHas('books.subscribers', function($query) use ($user) {
                $query->where('subscriber_id', $user->getKey());
            });
        });
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
//            ID::make(__('ID'), 'id'),
            Text::make(__('Name'), 'name')
                ->nullable(false)->required()
                ->sortable()->rules('required', 'max:30'),
            Text::make(__('Code'), 'code')->hideFromIndex()
                ->nullable(true)->sortable()->rules( 'max:20'),
            Image::make(__('Image'), 'image')
                ->store(function (Request $request, $model, $attribute, $requestAttribute) {
                    return ImageService::uploadCardImage($request->file($requestAttribute));
                })->disk(ImageService::diskName())->nullable(true)->prunable(),
            BelongsTo::make(__('Scope'), 'scope', Card::class)
                ->nullable(true)->sortable(),
            Textarea::make(__('Desc'), 'desc')
                ->nullable()->alwaysShow(),
            Textarea::make(__('Info'), 'info')
                ->nullable(),
            Number::make(__('Decks Count'), 'decks_count')
                ->hideWhenCreating()->hideWhenUpdating(),
            BelongsToMany::make(__('Domes'), 'domes', Dome::class),
            BelongsToMany::make(__('Lands'), 'lands', Land::class),
            BelongsToMany::make(__('Areas'), 'areas', Area::class),
            BelongsToMany::make(__('Scenes'), 'scenes', Scene::class),
            BelongsToMany::make(__('Books'), 'books', Book::class),
            HasMany::make(__('Decks'), 'decks', Deck::class),
            HasMany::make(__('Scoped Cards'), 'scopedCards', Card::class),
            HasMany::make(__('Scoped Decks'), 'scopedDecks', Deck::class),
//            BelongsToMany::make(__('Tags'), 'tags', Card::class),
//            HasMany::make(__('Tagged Cards'), 'taggedCards', Card::class),
            BelongsToMany::make(__('In Decks'), 'inDecks', Deck::class)
                ->fields(function () {
                    return [
                        Number::make(__('Count'), 'count')
                            ->nullable(false)->sortable()
                            ->required(true)
                            ->rules('required')
                            ->min(1)->step(1)->default(1),
                    ];
                }),

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

    /**
     * Build a "relatable" query for the given resource.
     *
     * This query determines which instances of the model may be attached to other resources.
     *
     * @param NovaRequest $request
     * @param  Builder  $query
     * @return Builder
     */
    public static function relatableQuery(NovaRequest $request, $query): Builder
    {
        return static::setScopeByCode($request, $query);
    }

    /**
     * @param NovaRequest $request
     * @param Builder $query
     * @return Builder
     */
    protected static function setScopeByCode(NovaRequest $request, Builder $query): Builder
    {
        if (!$code = strtolower($request->segment(4))) {
            return $query;
        }
        $code = Str::singular($code);
        $codes = ['hero', 'area', 'dome'];
        if (!in_array($code, $codes)) {
            return $query;
        }

        /** @var \App\Models\Card|null $card */
        $card = \App\Models\Card::query()->where("code", $code)->first();
        if ($card) {
            $query->where('scope_id', $card->getKey());
        }

        return $query;
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
            new BooksFilter(),
            new ImageFilter()
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
        return [
            CopyCard::make()->canRun(function () {
                return true;
            })
        ];
    }
}
