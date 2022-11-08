<?php

namespace App\Nova\Filters;

use App\Models\Scope;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Nova\Filters\Filter;

class ScopeFiler extends Filter
{
    /**
     * The displayable name of the filter.
     *
     * @var string
     */
    public $name = 'Scope';

    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

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
        return $query->where('scope_id', $value);
    }

    /**
     * Get the filter's available options.
     *
     * @param Request $request
     * @return array
     */
    public function options(Request $request): array
    {
        return array_flip(Scope::options());
    }
}
