<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Textarea;
use App\Nova\Actions\CopyDeck;
use App\Nova\Filters\ScopesFilter;
use App\Nova\Filters\TargetsFilter;
use App\Nova\Filters\IsPublicFilter;
use App\Nova\Filters\DeckTypeFilter;

/**
 * @mixin \App\Models\Deck
 */
class Deck extends Content
{
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
            BelongsTo::make(__('Target'), 'target', Card::class)
                ->nullable(false)->sortable()
                ->required()->rules('required'),
            BelongsTo::make(__('Scope'), 'scope', Card::class)
                ->nullable(false)->sortable()
                ->required()->rules('required'),
            BelongsTo::make(__('Book'), 'book', Book::class)
                ->nullable(false)->sortable()
                ->required()->rules('required'),
            Select::make(__('Type'), 'type')->nullable(false)
                ->required()->rules('required')->sortable()
                ->options(\App\Models\Deck::getTypeOptions())->displayUsingLabels(),
            Number::make(__('Size'), 'size')
                ->nullable(true)->hideWhenCreating()->hideWhenUpdating(),
            Boolean::make(__('Is Public'), 'is_public')
                ->nullable(false)->required()->default(function($request) {
                    return false;
                }),
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
            TargetsFilter::make(),
            ScopesFilter::make(),
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
            CopyDeck::make()->canRun(function () {
                return true;
            })
        ];
    }
}
