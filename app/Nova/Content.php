<?php

namespace App\Nova;

use Illuminate\Http\Request;
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
            new TagsFilter()
        ];
    }
}
