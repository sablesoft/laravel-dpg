<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use App\Nova\Actions\CacheContent;

/**
 * @mixin \App\Models\User
 */
class User extends Resource
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
    public static string $model = \App\Models\User::class;

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name', 'email',
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
            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Gravatar::make()->maxWidth(50),

            Image::make(__('Image'), 'image')
                ->nullable(true)->hideFromIndex(),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),

            BelongsTo::make(__('Language'), 'language')
                ->nullable(true)->sortable(),
            Image::make('Flag', function(\App\Models\User $user) {
                return $user->language ? $user->language->code . '.svg' : null;
            })->disk('flags')->disableDownload()->hideWhenCreating()->hideWhenUpdating(),
            File::make(__('Content'), 'content_path')->disk('local'),

            HasMany::make(__('Adventures'), 'adventures'),
            HasMany::make(__('Decks'), 'decks'),
            HasMany::make(__('Cards'), 'cards'),
            HasMany::make(__('Tags'), 'tags'),
            HasMany::make(__('Scopes'), 'scopes'),
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
        return [
            new CacheContent()
        ];
    }
}
