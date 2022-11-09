<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use OptimistDigtal\NovaMultiselectFilter\MultiselectFilter;
use App\Models\Deck;

class DecksFilter extends MultiselectFilter
{
    /**
     * The displayable name of the filter.
     *
     * @var string
     */
    public $name = 'Decks';

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
        return $query->whereHas('decks', function ($query) use ($value) {
            $query->whereIn('deck_id', $value);
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
        return Deck::options();
    }
}