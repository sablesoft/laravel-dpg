<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Textarea;
use App\Service\ImageService;

/**
 * @mixin \App\Models\Scene
 */
class Scene extends Content
{
    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Space';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = \App\Models\Scene::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * Get the fields displayed by the resource.
     *
     * @param Request $request
     * @return array
     */
    public function fields(Request $request): array
    {
        return [
            BelongsTo::make(__('Card'), 'scene', Card::class)->sortable(),
            Image::make(__('Card Image'), 'card_image')
                ->hideWhenCreating()->hideWhenUpdating(),
            Textarea::make(__('Desc'), 'desc')
                ->nullable()->alwaysShow(),
            Image::make(__('Scene Image'), 'image')
                ->store(function (Request $request, $model, $attribute, $requestAttribute) {
                    return ImageService::uploadSceneImage($request->file($requestAttribute));
                })->hideFromIndex()->disk(ImageService::diskName())->nullable(true)->prunable(),
            Code::make(__('Markers'), 'markers')->json(),
            Number::make(__('Decks Count'), 'decks_count')
                ->hideWhenCreating()->hideWhenUpdating(),
            Number::make(__('Cards Count'), 'cards_count')
                ->hideWhenCreating()->hideWhenUpdating(),
            Boolean::make(__('Is Public'), 'is_public')
                ->nullable(false)->sortable(),
            BelongsTo::make(__('Owner'), 'owner', User::class)
                ->sortable()->hideWhenUpdating()->hideWhenCreating(),
            DateTime::make(__('Created At'), 'created_at')
                ->hideFromIndex()
                ->hideWhenCreating()->hideWhenUpdating()->sortable(true),
            DateTime::make(__('Updated At'), 'updated_at')
                ->hideFromIndex()
                ->hideWhenCreating()->hideWhenUpdating()->sortable(true),
            BelongsToMany::make(__('Sources'), 'sources', Book::class),
            BelongsToMany::make(__('Cards'), 'cards'),
            HasMany::make(__('Decks'), 'decks', Deck::class),
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
        return array_merge(parent::filters($request), []);
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
