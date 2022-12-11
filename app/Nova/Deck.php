<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Http\Requests\ResourceDetailRequest;
use App\Service\ImageService;
use App\Nova\Actions\CopyDeck;
use App\Nova\Filters\AreasFilter;
use App\Nova\Filters\BooksFilter;
use App\Nova\Filters\DomesFilter;
use App\Nova\Filters\OwnersFilter;
use App\Nova\Filters\ScopesFilter;
use App\Nova\Filters\TargetsFilter;
use App\Nova\Filters\IsPublicFilter;
use App\Nova\Filters\DeckTypeFilter;

/**
 * @mixin \App\Models\Deck
 */
class Deck extends Content
{
    public static $displayInNavigation = false;

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
            BelongsTo::make(__('Book'), 'book', Book::class)
                ->hideFromIndex()->hideWhenCreating()->readonly()
                ->showOnUpdating(function(NovaRequest $request) {
                    return $this->checkDeckType($request, 'book_id');
                })->showOnDetail(function(NovaRequest $request) {
                    return $this->checkDeckType($request, 'book_id');
                }),
            BelongsTo::make(__('Dome'), 'dome', Dome::class)
                ->hideFromIndex()->hideWhenCreating()->readonly()
                ->showOnUpdating(function(NovaRequest $request) {
                    return $this->checkDeckType($request, 'dome_id');
                })->showOnDetail(function(NovaRequest $request) {
                    return $this->checkDeckType($request, 'dome_id');
                }),
            BelongsTo::make(__('Land'), 'land', Land::class)
                ->hideFromIndex()->hideWhenCreating()->readonly()
                ->showOnUpdating(function(NovaRequest $request) {
                    return $this->checkDeckType($request, 'land_id');
                })->showOnDetail(function(NovaRequest $request) {
                    return $this->checkDeckType($request, 'land_id');
                }),
            BelongsTo::make(__('Area'), 'area', Area::class)
                ->hideFromIndex()->hideWhenCreating()->readonly()
                ->showOnUpdating(function(NovaRequest $request) {
                    return $this->checkDeckType($request, 'area_id');
                })->showOnDetail(function(NovaRequest $request) {
                    return $this->checkDeckType($request, 'area_id');
                }),
            BelongsTo::make(__('Game'), 'game', Game::class)
                ->hideFromIndex()->hideWhenCreating()->readonly()
                ->showOnUpdating(function(NovaRequest $request) {
                    return $this->checkDeckType($request, 'game_id');
                })->showOnDetail(function(NovaRequest $request) {
                    return $this->checkDeckType($request, 'game_id');
                }),
            BelongsTo::make(__('Scene'), 'scene', Scene::class)
                ->hideFromIndex()->hideWhenCreating()->readonly()
                ->showOnUpdating(function(NovaRequest $request) {
                    return $this->checkDeckType($request, 'scene_id');
                })->showOnDetail(function(NovaRequest $request) {
                    return $this->checkDeckType($request, 'scene_id');
                }),
            BelongsTo::make(__('Target'), 'target', Card::class)
                ->nullable(false)->sortable()
                ->required()->rules('required'),
            Image::make('', 'target_image')
                ->disk(ImageService::diskName())->onlyOnIndex(),
            BelongsTo::make(__('Scope'), 'scope', Card::class)
                ->nullable(false)->sortable()
                ->required()->rules('required'),
            Image::make('', 'scope_image')
                ->disk(ImageService::diskName())->onlyOnIndex(),
            Select::make(__('Type'), 'type')->nullable(false)
                ->required()->rules('required')->sortable()
                ->options(\App\Models\Deck::getTypeOptions())->displayUsingLabels(),
            Number::make(__('Count'), 'cards_count')
                ->hideWhenCreating()->hideWhenUpdating(),
            Number::make(__('Size'), 'size')
                ->nullable(true)->hideWhenCreating()->hideWhenUpdating(),
            Boolean::make(__('Is Public'), 'is_public')
                ->nullable(false)->required()->default(function($request) {
                    return false;
                }),
            BelongsTo::make(__('Owner'), 'owner', User::class)
                ->sortable()->hideWhenUpdating()->hideWhenCreating(),
            BelongsToMany::make(__('Cards'), 'cards', Card::class)
                ->fields(function () {
                    return [
                        Number::make(__('Count'), 'count')
                            ->nullable(false)->sortable()
                            ->required(true)
                            ->rules('required')
                            ->min(1)->step(1)->default(1),
                    ];
                })->sortable()->nullable(true),
            Image::make(__('Image'), 'image')->prunable()
                ->nullable(true)->hideFromIndex(),
            Textarea::make(__('Desc'), 'desc')
                ->nullable()->alwaysShow(),
            BelongsToMany::make(__('Tags'), 'tags', Card::class)
        ];
    }

    /**
     * @param NovaRequest $request
     * @param $field
     * @return bool
     */
    public function checkDeckType(NovaRequest $request, $field): bool
    {
        $resource = $request->findResourceOrFail();
        /** @var \App\Models\Deck $model */
        $model = $resource->model();
        return $model && !!$model->$field;
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
            DeckTypeFilter::make(),
            BooksFilter::make(false),
            DomesFilter::make(),
            AreasFilter::make(),
            TargetsFilter::make(),
            ScopesFilter::make(),
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
            CopyDeck::make()->canRun(function ($request, $model) {
                $string = $request->input('resources');
                $ids = explode(',', $string);
                $ids = array_map('trim', $ids);

                return in_array($model->getKey(), $ids);
            })
        ];
    }
}
