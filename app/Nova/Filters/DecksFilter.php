<?php

namespace App\Nova\Filters;

use App\Models\Deck;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class DecksFilter extends ContentFilter
{
    /**
     * The displayable name of the filter.
     *
     * @var string
     */
    public $name = 'Decks';

    /**
     * @param string $whereInField
     * @param bool $useWhereHas
     */
    public function __construct(bool $useWhereHas = true, string $whereInField = 'deck_id')
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
        return $this->applyWhereHasAndWhereIn($query, $value, 'decks');
    }

    /**
     * Get the filter's available options.
     *
     * @param Request $request
     * @return array
     */
    public function options(Request $request): array
    {
        $options = [];
        $query = Deck::query();
        /** @var User $user */
        $user = Auth::user();
        if (!$user->isAdmin()) {
            $query->where('is_public', true)->orWhere('owner_id', $user->getKey());
        }

        /** @var Deck $deck */
        foreach ($query->get() as $deck) {
            $options[$deck->getKey()] = $deck->name;
        }

        return $options;
    }
}
