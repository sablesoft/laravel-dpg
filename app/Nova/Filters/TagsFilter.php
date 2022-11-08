<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use OptimistDigtal\NovaMultiselectFilter\MultiselectFilter;
use App\Models\Tag;

class TagsFilter extends MultiselectFilter
{
    /**
     * The displayable name of the filter.
     *
     * @var string
     */
    public $name = 'Tags';

    /**
     * @param Request $request
     * @param $query
     * @param $value
     * @return Builder
     */
    public function apply(Request $request, $query, $value): Builder
    {
        return $query->whereHas('tags', function ($query) use ($value) {
            $query->whereIn('tag_id', $value);
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
        return Tag::options();
    }
}
