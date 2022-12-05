<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Textarea;
use Codebykyle\CalculatedField\BroadcasterField;
use Codebykyle\CalculatedField\ListenerField;
use App\Service\ImageService;
use App\Nova\Actions\AreaImage;

/**
 * @mixin \App\Models\Area
 */
class Area extends Content
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = \App\Models\Area::class;

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
            BelongsTo::make(__('Card'), 'area', Card::class),
            Image::make(__('Card Image'), 'card_image')
                ->hideWhenCreating()->hideWhenUpdating(),
            BelongsTo::make(__('Dome'), 'dome', Dome::class),
            Textarea::make(__('Desc'), 'desc')
                ->nullable()->alwaysShow(),
            Image::make(__('Area Image'), 'image')
                ->store(function (Request $request, $model, $attribute, $requestAttribute) {
                    /** @var \App\Models\Area $model */
                    return ImageService::uploadAreaImage($request->file($requestAttribute), $model->dome);
                })->disk(ImageService::diskName())->nullable(true)->prunable(),
            BroadcasterField::make(__('Top Step'), 'top_step')
                ->broadcastTo('top'),
            ListenerField::make(__('Top'), 'top')->calculateWith(function(Collection $values) {
                $step = 1;
                if ($id = $values->get('resourceId')) {
                    /** @var \App\Models\Area $area */
                    $area = \App\Models\Area::find($id);
                    $step = $area->dome->top_step;
                }
                return (int) ($values->get('top_step') * $step);
            })->hideFromIndex()->listensTo('top'),
            BroadcasterField::make(__('Left Step'), 'left_step')
                ->broadcastTo('left'),
            ListenerField::make(__('Left'), 'left')->calculateWith(function(Collection $values) {
                $step = 1;
                if ($id = $values->get('resourceId')) {
                    /** @var \App\Models\Area $area */
                    $area = \App\Models\Area::find($id);
                    $step = $area->dome->left_step;
                }
                return (int) ($values->get('left_step') * $step);
            })->hideFromIndex()->listensTo('left'),
            Code::make(__('Markers'), 'markers')->json(),
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
        return [
            AreaImage::make()->onlyOnDetail()
        ];
    }
}
