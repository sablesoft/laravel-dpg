<?php

namespace App\Nova;


use Closure;
use Ganyicz\NovaTemporaryFields\HasTemporaryFields;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Enums\GameStatus;
use App\Enums\GameSubscribe;
use App\Service\ImageService;
use App\Nova\Filters\OwnersFilter;
use App\Nova\Filters\IsPublicFilter;
use App\Nova\Filters\GameStatusFilter;
use App\Nova\Actions\Game\InitProcess;
use App\Nova\Actions\Game\InviteSubscribers;
use App\Models\Traits\Subscribers;

/**
 * @mixin \App\Models\Game
 */
class Game extends Resource
{
    use HasTemporaryFields, Subscribers;

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Personal';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = \App\Models\Game::class;

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
        'name',
    ];

    /**
     * @param NovaRequest $request
     * @param Builder $query
     * @return Builder
     */
    public static function indexQuery(NovaRequest $request, $query): Builder
    {
        return static::staticAllowedToSee($query);
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
            Text::make(__('Name'), 'name')->sortable()
                ->nullable(false)->required(true)->rules('required'),
            Image::make(__('Image'), 'image')
                ->store(function (Request $request, $model, $attribute, $requestAttribute) {
                    return ImageService::uploadGameImage($request->file($requestAttribute));
                })->disk(ImageService::diskName())->nullable(true)->prunable(),
            Select::make(__('Status'), 'status_value')
                ->sortable()->temporary()
                ->nullable(false)->required(true)->rules('required')
                ->options(GameStatus::options())->displayUsingLabels(),
            BelongsToMany::make(__('Books'), 'books', Book::class),
            BelongsToMany::make(__('Heroes'), 'heroes', Hero::class),
            BelongsTo::make(__('Main Quest'), 'quest', Card::class)
                ->nullable(true)->sortable()->hideWhenCreating(),
            BelongsToMany::make(__('Cards'), 'cards', Card::class),
            HasMany::make(__('Decks'), 'decks', Deck::class),
            BelongsTo::make(__('Master'), 'owner', User::class)
                ->hideWhenCreating()->sortable()->readonly(true),
            Textarea::make(__('Desc'), 'desc')->nullable(true)->alwaysShow(),
            Image::make(__('Board Image'), 'board_image')
                ->store(function (Request $request, $model, $attribute, $requestAttribute) {
                    return ImageService::uploadBoardImage($request->file($requestAttribute));
                })->disk(ImageService::diskName())->nullable(true)->prunable()->hideFromIndex(),
            Image::make(__('Cards Back'), 'cards_back')
                ->store(function (Request $request, $model, $attribute, $requestAttribute) {
                    return ImageService::uploadCardBack($request->file($requestAttribute));
                })->maxWidth(ImageService::backHeight())->disk(ImageService::diskName())
                ->prunable()->nullable(true),
            Boolean::make(__('Is Public'), 'is_public')
                ->nullable(false)->sortable(),
            BelongsToMany::make(__('Subscribers'), 'subscribers', User::class)
                ->fields(function () {
                    return [
                        Select::make(__('Type'), 'type')
                            ->nullable(false)->sortable()
                            ->default(function($request) { return GameSubscribe::Spectator->value; })
                            ->options(GameSubscribe::options())
                            ->displayUsingLabels(),
                    ];
                })->sortable()->nullable(true),
            HasMany::make(__('Stories'), 'stories', Story::class),
        ];
    }

    /**
     * @return Closure
     */
    public static function isGameOwner(): Closure
    {
        return function(NovaRequest $request) {
            /** @var \App\Models\Game $game */
            $game = $request->findModelQuery()->first();
            if (!$game) {
                return true;
            }

            /** @var \App\Models\User $user */
            $user = Auth::user();

            return $user->isAdmin() || $game->isOwnedBy($user);
        };
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
            GameStatusFilter::make(),
            OwnersFilter::make(),
            IsPublicFilter::make()
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
            InviteSubscribers::make()->onlyOnDetail(true),
            InitProcess::make()->onlyOnDetail(true),
        ];
    }
}
