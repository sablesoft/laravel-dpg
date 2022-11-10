<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Card;

class CardsFilter extends ContentFilter
{
    /**
     * The displayable name of the filter.
     *
     * @var string
     */
    public $name = 'Cards';

    /**
     * @var string|mixed
     */
    protected string $whereInField = 'card_id';

    /**
     * @param string $whereInField
     */
    public function __construct(string $whereInField = 'card_id')
    {
        $this->whereInField = $whereInField;
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
        return $query->whereHas('cards', function ($query) use ($value) {
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
