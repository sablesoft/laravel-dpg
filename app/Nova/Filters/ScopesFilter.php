<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Card;

class ScopesFilter extends ContentFilter
{
    /**
     * The displayable name of the filter.
     *
     * @var string
     */
    public $name = 'Scopes';

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
        return $query->whereIn('scope_id', $value);
    }

    /**
     * Get the filter's available options.
     *
     * @param Request $request
     * @return array
     */
    public function options(Request $request): array
    {
        return Card::options();
    }
}
