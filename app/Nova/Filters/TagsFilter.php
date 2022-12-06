<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Card;

class TagsFilter extends ContentFilter
{
    /**
     * The displayable name of the filter.
     *
     * @var string
     */
    public $name = 'Tags';

    /**
     * @param string $whereInField
     * @param bool $useWhereHas
     */
    public function __construct(string $whereInField = 'tag_id', bool $useWhereHas = true)
    {
        parent::__construct($useWhereHas, $whereInField);
    }

    /**
     * @param Request $request
     * @param $query
     * @param $value
     * @return Builder
     */
    public function apply(Request $request, $query, $value): Builder
    {
        return $this->applyWhereHasAndWhereIn($query, $value, 'tags');
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
