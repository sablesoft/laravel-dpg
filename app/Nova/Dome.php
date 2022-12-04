<?php

namespace App\Nova;

use App\Service\ImageService;
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

/**
 * @mixin \App\Models\Dome
 */
class Dome extends Content
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = \App\Models\Dome::class;

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
            BelongsTo::make(__('Card'), 'dome', Card::class)
                ->nullable(false)->required(true)->rules('required'),
            Image::make(__('Card Image'), 'card_image')
                ->hideWhenCreating()->hideWhenUpdating(),
            Textarea::make(__('Desc'), 'desc')
                ->nullable()->alwaysShow(),
            Image::make(__('Map'), 'image')->maxWidth('auto')
                ->store(function (Request $request, $model, $attribute, $requestAttribute) {
                    /** @var \App\Models\Dome $model */
                    return ImageService::uploadDomeImage($request->file($requestAttribute), $model);
                })->hideFromIndex()->disk(ImageService::diskName())
                ->nullable(false)->required()->rules('file')->prunable(),
            Number::make(__('Area Width'), 'area_width')
                ->nullable(false)->required(true)->rules('required'),
            Number::make(__('Area Height'), 'area_height')
                ->nullable(false)->required(true)->rules('required'),
            Number::make(__('Left Step'), 'left_step')->step(0.01)
                ->nullable(false)->required(true)->rules('required'),
            Number::make(__('Top Step'), 'top_step')->step(0.01)
                ->nullable(false)->required(true)->rules('required'),
            Code::make(__('Area Mask'), 'area_mask')->json()
                ->nullable(true)->required(false)->hideFromIndex(),
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
            HasMany::make(__('Areas'), 'areas', Area::class),
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
        return parent::filters($request);
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
