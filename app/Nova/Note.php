<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

/**
 * @mixin \App\Models\Guide\Note
 */
class Note extends Resource
{
    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Guide';

    public static $displayInNavigation = false;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = \App\Models\Guide\Note::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param Request $request
     * @return array
     */
    public function fields(Request $request): array
    {
        return [
            BelongsTo::make(__('Project'), 'project')
                ->readonly()->hideWhenCreating()->hideFromIndex()
                ->showOnUpdating(function(NovaRequest $request) {
                    return $this->checkNoteType($request, 'project_id');
                })->showOnDetail(function(NovaRequest $request) {
                    return $this->checkNoteType($request, 'project_id');
                }),
            BelongsTo::make(__('Post'), 'post')
                ->readonly()->hideWhenCreating()->hideFromIndex()
                ->showOnUpdating(function(NovaRequest $request) {
                    return $this->checkNoteType($request, 'post_id');
                })->showOnDetail(function(NovaRequest $request) {
                    return $this->checkNoteType($request, 'post_id');
                }),
            BelongsTo::make(__('Topic'), 'topic')
                ->nullable(false)->required(true)
                ->rules('required'),
            Text::make(__('Content'), 'content')
                ->onlyOnIndex()->displayUsing(function ($text) {
                    if (mb_strlen($text) > 90) {
                        return mb_substr($text, 0, 90) . '...';
                    }
                    return $text;
                }),
            Textarea::make(__('Content'), 'content')
                ->nullable(true)->required(false)->alwaysShow(),
            DateTime::make(__('Created At'), 'created_at')
                ->hideFromIndex()
                ->hideWhenCreating()->hideWhenUpdating()->sortable(true),
            DateTime::make(__('Updated At'), 'updated_at')
                ->hideFromIndex()
                ->hideWhenCreating()->hideWhenUpdating()->sortable(true),
        ];
    }

    /**
     * @param NovaRequest $request
     * @param $field
     * @return bool
     */
    public function checkNoteType(NovaRequest $request, $field): bool
    {
        $resource = $request->findResourceOrFail();
        /** @var \App\Models\Guide\Note $model */
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
        return [];
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
