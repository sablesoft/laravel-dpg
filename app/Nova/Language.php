<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;

/**
 * @mixin \App\Models\Language
 */
class Language extends Resource
{
    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Admin';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = \App\Models\Language::class;

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'code', 'name'
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
            Image::make(__('Flag'), function($language) {
                return $language->code . '.svg';
            })->disk('flags')->disableDownload()->hideWhenCreating()->hideWhenUpdating(),
            Text::make(__('Code'), 'code')
                ->nullable(false)->required()->rules('required', 'max:5')
                ->hideWhenUpdating()->hideWhenCreating(),
            Select::make(__('Code'), 'code')
                ->options(\App\Models\Language::getAllCodesList())->searchable()
                ->hideWhenUpdating()->hideFromIndex()->hideFromDetail(),
            Text::make(__('Code'), 'code')
                ->nullable(false)->readonly()
                ->hideWhenCreating()->hideFromIndex()->hideFromDetail(),
            Text::make(__('Name'), 'name')
                ->nullable(false)->required()->rules('required','max:20'),
            HasMany::make(__('Users'), 'users', User::class)
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
