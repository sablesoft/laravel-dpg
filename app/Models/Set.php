<?php

namespace App\Models;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Traits\Owner;
use App\Models\Traits\FromDeck;

/**
 * @property-read string|null $cards_string
 *
 * @property-read Card[]|null $cards
 */
class Set extends Model
{
    use FromDeck, Owner;

    /**
     * @return string|null
     */
    public function getCardsStringAttribute(): ?string
    {
        $links = [];
        $path = trim(config('nova.path'), '/');
        foreach ($this->cards as $card) {
            $href = url(sprintf("/$path/resources/units/%d", $card->getKey()));
            $name = $card->name ." [". $card->pivot->level ."|". $card->pivot->points ."]" ;
            $links[] = "<a href='$href' class='no-underline dim text-primary font-bold'>$name</a>";
        }

        return $links ? implode(', ', $links) : null;
    }

    /**
     * @return BelongsToMany
     */
    public function cards(): BelongsToMany
    {
        return $this->belongsToMany(
            Card::class,
            'set_card'
        )->withPivot(['level', 'points']);
    }

    /**
     * @param Game $game
     * @param Deck $deck
     * @return static
     * @throws Exception
     */
    public static function createFromDeck(Game $game, Deck $deck): static
    {
        /** @var Set $set */
        $set = static::prepareFromDeck($game, $deck, Deck::TYPE_SET);
        $set->save();
        foreach ($deck->cards as $card) {
            $set->cards()->attach($card, [
                'level' => $card->pivot->count
            ]);
        }

        return $set;
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function (Set $set) {
            $set->owner()->associate(Auth::user());
        });
    }
}
