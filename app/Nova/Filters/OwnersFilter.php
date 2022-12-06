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
     * @param string $whereInField
     * @param bool $useWhereHas
     */
    public function __construct(string $whereInField = 'owner_id', bool $useWhereHas = false)
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
        return $this->applyWhereHasAndWhereIn($query, $value, 'owners');
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
