<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;

class OwnersFilter extends ContentFilter
{
    /**
     * The displayable name of the filter.
     *
     * @var string
     */
    public $name = 'Owners';

    /**
     * Apply the filter to the given query.
     *
     * @param Request $request
     * @param  Builder  $query
     * @param  mixed  $value
     * @return Builder
     */
    public function apply(Request $request, $query, $value): Builder
    {
        return $query->whereIn('owner_id', $value);
    }

    /**
     * Get the filter's available options.
     *
     * @param Request $request
     * @return array
     */
    public function options(Request $request): array
    {
        return User::options();
    }
}
