<?php

namespace App\Nova\Filters;

use App\Models\Card;
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
