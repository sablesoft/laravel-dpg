<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Nova\Filters\BooleanFilter;

class ImageFilter extends BooleanFilter
{
    /**
     * The displayable name of the filter.
     *
     * @var string
     */
    public $name = 'Has Image';

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
        $hasImage = $value['yes'] && !$value['no'];
        if ($hasImage) {
            return $query->whereNotNull('image');
        } else {
            return $query->whereNull('image');
        }

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
