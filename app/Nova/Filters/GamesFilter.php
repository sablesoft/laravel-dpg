<?php

namespace App\Nova\Filters;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class GamesFilter extends ContentFilter
{
    /**
     * The displayable name of the filter.
     *
     * @var string
     */
    public $name = 'Games';

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
        return $query->whereIn('game_id', $value);
    }

    /**
     * Get the filter's available options.
     *
     * @param Request $request
     * @return array
     */
    public function options(Request $request): array
    {
        return Game::all()->pluck('name', 'id')->all();
    }
}
