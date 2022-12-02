<?php /** @noinspection PhpInconsistentReturnPointsInspection */

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\BelongsTo;
use App\Service\ImageService;
use App\Nova\Filters\ScopesFilter;
use App\Nova\Filters\TargetsFilter;

/**
 * @mixin \App\Models\State
 */
class State extends Resource
{
    public static $displayInNavigation = false;

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Play';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = \App\Models\State::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

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
            BelongsTo::make(__('Game'), 'game', Game::class)
                ->readonly()->sortable(),
            BelongsTo::make(__('Target'), 'target', Card::class)
                ->readonly()->sortable(),
            Image::make('', 'target_image')
                ->disk(ImageService::diskName())->onlyOnIndex(),
            BelongsTo::make(__('Scope'), 'scope', Card::class)
                ->readonly()->sortable(),
            Image::make('', 'scope_image')
                ->disk(ImageService::diskName())->onlyOnIndex(),
            BelongsTo::make(__('State'), 'state', Card::class)
                ->nullable(true)->sortable()->required(false)
                ->rules('integer', function($attribute, $value, $fail) {
                    /** @var \App\Models\Card|null $scope */
                    $scope = \App\Models\Card::select()->where('id', $this->scope_id)->first();
                    /** @var \App\Models\Card|null $card */
                    $card = \App\Models\Card::select()->where('id', $value)->first();
                    if ($card && $scope) {
                        if (!\App\Models\Card::validateScope($scope, $card)) {
                            return $fail('Invalid scope for state! Must be in ' . $scope->name . '!');
                        }
                    }
                }),
            Image::make('', 'state_image')
                ->disk(ImageService::diskName())->onlyOnIndex(),
            DateTime::make(__('Created At'), 'created_at')
                ->hideFromIndex()
                ->hideWhenCreating()->hideWhenUpdating()->sortable(true),
            DateTime::make(__('Updated At'), 'updated_at')
                ->hideFromIndex()
                ->hideWhenCreating()->hideWhenUpdating()->sortable(true),
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
            TargetsFilter::make(),
            ScopesFilter::make(),
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
        return [];
    }
}
