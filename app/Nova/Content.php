<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Nova\Filters\TagsFilter;
use App\Nova\Filters\OwnersFilter;
use App\Nova\Filters\IsPublicFilter;

abstract class Content extends Resource
{
    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Content';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name'
    ];


    /**
     * Build an "index" query for the given resource.
     *
     * @param NovaRequest $request
     * @param  Builder  $query
     * @return Builder
     */
    public static function indexQuery(NovaRequest $request, $query): Builder
    {
        if ($request->user()->hasRole(\App\Models\User::ROLE_ADMIN)) {
            return $query;
        }

        return $query->where('is_public', '=', true)
            ->orWhere('owner_id', '=', $request->user()->getKey());
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
            new TagsFilter(),
            new IsPublicFilter(),
            new OwnersFilter(),
        ];
    }
}
