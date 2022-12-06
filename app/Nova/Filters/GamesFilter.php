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
     * @param string $whereInField
     * @param bool $useWhereHas
     */
    public function __construct(string $whereInField = 'game_id', bool $useWhereHas = false)
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
        return $this->applyWhereHasAndWhereIn($query, $value, 'games');
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
