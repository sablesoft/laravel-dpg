<?php

namespace App\Nova;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Enums\GameStatus;
use App\Service\ImageService;
use App\Nova\Filters\OwnersFilter;
use App\Nova\Filters\IsPublicFilter;
use App\Nova\Filters\GameStatusFilter;

/**
 * @mixin \App\Models\Game
 */
class Game extends Resource
{
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
    public static $title = 'prepared_name';

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
        /** @noinspection PhpUndefinedMethodInspection */
        return $query->allowedToSee();
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
            Text::make(__('Name'), 'prepared_name')->sortable()
                ->nullable(true)->required(false)
                ->hideWhenCreating()->hideWhenUpdating(),
            Select::make(__('Status'), 'status_value')
                ->sortable()
                ->nullable(false)->required(true)->rules('required')
                ->options(GameStatus::options())->displayUsingLabels(),
            BelongsTo::make(__('Book'), 'book', Book::class)
                ->sortable()->nullable(false)->required()
                ->rules('required')->hideWhenUpdating(),
            BelongsTo::make(__('Book'), 'book', Book::class)
                ->hideWhenCreating()->hideFromIndex()->hideFromDetail()
                ->readonly(),
            BelongsTo::make(__('Hero'), 'hero', Card::class)
                ->nullable(true)->sortable()->hideWhenCreating(),
            BelongsTo::make(__('Main Quest'), 'quest', Card::class)
                ->nullable(true)->sortable()->hideWhenCreating(),
            BelongsTo::make(__('Master'), 'owner', User::class)
                ->hideWhenCreating()->sortable()->readonly(true),
            Text::make(__('Name'), 'name')->sortable()
                ->nullable(true)->required(false)
                ->hideFromIndex()->hideFromDetail(),
            Textarea::make(__('Desc'), 'desc')->nullable(true)->alwaysShow(),
            Image::make(__('Board Image'), 'board_image')
                ->store(function (Request $request, $model, $attribute, $requestAttribute) {
                    return ImageService::uploadBoardImage($request->file($requestAttribute));
                })->disk(ImageService::diskName())->nullable(true)->prunable()->hideFromIndex(),
            Boolean::make(__('Is Public'), 'is_public')
                ->nullable(false)->sortable(),
            BelongsToMany::make(__('Subscribers'), 'subscribers', User::class)
                ->fields(function () {
                    return [
                        Select::make(__('Type'), 'type')
                            ->nullable(false)->sortable()
                            ->default(function($request) { return 0; })
                            ->options(\App\Models\Game::subscriberTypeOptions())
                            ->displayUsingLabels(),
                    ];
                })->sortable()->nullable(true),
            HasMany::make(__('Uniques'), 'uniques', Unique::class),
            HasMany::make(__('Stacks'), 'stacks', Stack::class)->canSee(static::isGameOwner()),
            HasMany::make(__('Sets'), 'sets', Set::class)->canSee(static::isGameOwner()),
            BelongsToMany::make(__('Board'), 'board', Card::class),
            HasMany::make(__('Logs'), 'logs', Log::class),
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
        return [];
    }
}
