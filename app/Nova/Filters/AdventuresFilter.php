<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use OptimistDigtal\NovaMultiselectFilter\MultiselectFilter;
use App\Models\Adventure;

class AdventuresFilter extends MultiselectFilter
{
    /**
     * The displayable name of the filter.
     *
     * @var string
     */
    public $name = 'Adventures';

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
        return $query->whereHas('adventures', function ($query) use ($value) {
            $query->whereIn('adventure_id', $value);
        });
    }

    /**
     * Get the filter's available options.
     *
     * @param Request $request
     * @return array
     */
    public function options(Request $request): array
    {
        return Adventure::options();
    }
}
