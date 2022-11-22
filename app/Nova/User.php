<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use App\Nova\Actions\AssignRole;
use App\Nova\Actions\CacheContent;
use Laravel\Nova\Http\Requests\NovaRequest;

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

            Text::make(__('Roles'), function () {
                $names = $this->roles_names;
                $string = implode(",</span> <span style='display:inline-block;'>", $names);
                return $string ? "<span style='display:inline-block;'>$string</span>" : $string;
            })->readonly()->asHtml(),

            BelongsTo::make(__('Language'), 'language', Language::class)
                ->nullable(true)->sortable(),
            Image::make('Flag', function(\App\Models\User $user) {
                return $user->language ? $user->language->code . '.svg' : null;
            })->disk('flags')->disableDownload()->hideWhenCreating()->hideWhenUpdating(),
            File::make(__('Content'), 'content_path')->disk('local'),

            MorphToMany::make(__('Roles'), 'roles', Role::class),

            HasMany::make(__('Books'), 'books', Book::class),
            HasMany::make(__('Cards'), 'cards', Card::class),
            HasMany::make(__('Tags'), 'tags', Card::class),
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
     * @param NovaRequest $request
     * @return array
     */
    public function actions(Request $request): array
    {
        return [
            AssignRole::make()
                ->canSeeWhen(\App\Models\User::ROLE_ADMIN)
                ->canRun(function (NovaRequest $request) {
                    return $request->user()->hasRole(\App\Models\User::ROLE_ADMIN);
                }),
            CacheContent::make()->onlyOnDetail()
        ];
    }
}
