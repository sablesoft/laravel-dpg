<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use App\Service\ImageService;
use App\Nova\Actions\CopyBook;
use App\Nova\Filters\CardsFilter;
use App\Nova\Filters\ImageFilter;
use App\Nova\Filters\OwnersFilter;
use App\Nova\Filters\ScopesFilter;
use App\Nova\Filters\IsPublicFilter;
use Laravel\Nova\Http\Requests\NovaRequest;

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
            Text::make(__('Name'), 'name')
                ->nullable(false)->required()
                ->sortable()->rules('required', 'max:30'),
            Image::make(__('Image'), 'image')
                ->store(function (Request $request, $model, $attribute, $requestAttribute) {
                    return ImageService::uploadBookImage($request->file($requestAttribute));
                })->prunable()->disk(ImageService::diskName())->nullable(true),
            Number::make(__('Decks Count'), 'decks_count')
                ->hideWhenCreating()->hideWhenUpdating(),
            Number::make(__('Cards Count'), 'cards_count')
                ->hideWhenCreating()->hideWhenUpdating(),
            Text::make(__('Tags'), 'tags_string')
                ->hideFromIndex()->hideWhenCreating()->hideWhenUpdating()->asHtml(),
            Textarea::make(__('Desc'), 'desc')->nullable()->alwaysShow(),
            BelongsToMany::make(__('Domes'), 'domes', Dome::class),
            BelongsToMany::make(__('Scenes'), 'scenes', Scene::class),
            BelongsToMany::make(__('Sources'), 'sources', Book::class),
            HasMany::make(__('Decks'), 'decks', Deck::class),
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
                ->hideWhenCreating()->hideWhenUpdating()->sortable(true),
            BelongsToMany::make(__('Subscribers'), 'subscribers', User::class)
                ->fields(function () {
                    return [
                        Select::make(__('Type'), 'type')
                            ->nullable(false)->sortable()
                            ->default(function() { return 0; })
                            ->options(\App\Models\Book::subscriberTypeOptions())
                            ->displayUsingLabels(),
                    ];
                }),
            BelongsToMany::make(__('Used In Books'), 'usedInBooks', Book::class),
            BelongsToMany::make(__('Used In Domes'), 'usedInDomes', Dome::class),
            BelongsToMany::make(__('Used In Lands'), 'usedInLands', Land::class),
            BelongsToMany::make(__('Used In Areas'), 'usedInAreas', Area::class),
            BelongsToMany::make(__('Games'), 'games', Game::class)
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
            new CardsFilter(),
            new ImageFilter()
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
            CopyBook::make()->canRun(function ($request, $model) {
                $string = $request->input('resources');
                $ids = explode(',', $string);
                $ids = array_map('trim', $ids);

                return in_array($model->getKey(), $ids);
            })
        ];
    }
}
