<?php

namespace App\Nova\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\BooleanFilter;

class IsPublicFilter extends BooleanFilter
{
    /**
     * The displayable name of the filter.
     *
     * @var string
     */
    public $name = 'Is Public';

    /**
     * Get the displayable name of the filter.
     *
     * @return string
     */
    public function name(): string
    {
        return __(parent::name());
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
        if (($value['yes'] && $value['no']) || (!$value['yes'] && !$value['no'])) {
            return $query;
        }
        $is_public = $value['yes'] && !$value['no'];

        return $query->where('is_public', $is_public);
    }

    /**
     * Get the filter's available options.
     *
     * @param Request $request
     * @return array
     */
    public function options(Request $request): array
    {
        return [
            __('Yes') => 'yes',
            __('No')  => 'no'
        ];
    }
}
