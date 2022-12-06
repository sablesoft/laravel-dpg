<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Dome;

class DomesFilter extends ContentFilter
{
    /**
     * The displayable name of the filter.
     *
     * @var string
     */
    public $name = 'Domes';

    /**
     * @param string $whereInField
     * @param bool $useWhereHas
     */
    public function __construct(bool $useWhereHas = false, string $whereInField = 'dome_id')
    {
        parent::__construct($useWhereHas, $whereInField);
    }

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
        return $this->applyWhereHasAndWhereIn($query, $value, 'domes');
    }

    /**
     * Get the filter's available options.
     *
     * @param Request $request
     * @return array
     */
    public function options(Request $request): array
    {
        return Dome::options();
    }
}
