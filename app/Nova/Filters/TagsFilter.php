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
     * @var string|mixed
     */
    protected string $whereInField = 'tag_id';

    /**
     * @param string $whereInField
     */
    public function __construct(string $whereInField = 'tag_id')
    {
        $this->whereInField = $whereInField;
    }

    /**
     * @param Request $request
     * @param $query
     * @param $value
     * @return Builder
     */
    public function apply(Request $request, $query, $value): Builder
    {
        return $query->whereHas('tags', function ($query) use ($value) {
            $query->whereIn($this->whereInField, $value);
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
        return Card::options();
    }
}
