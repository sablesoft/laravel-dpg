<?php

namespace App\Models;

use Exception;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Traits\FromDeck;

/**
 * @property int|null $id
 * @property int|null $game_id
 * @property int|null $deck_id
 * @property int|null $card_id
 * @property int|null $scope_id
 * @property string|null $desc
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read string|null $name
 * @property-read string|null $cards_string
 *
 * @property-read Game|null $game
 * @property-read Deck|null $deck
 * @property-read Card|null $target
 * @property-read Card|null $scope
 * @property-read Card[]|null $cards
 */
class Set extends Model
{
    use FromDeck;

    /**
     * @return string|null
     */
    public function getNameAttribute(): ?string
    {
        $target = optional($this->target)->name;
        $scope = optional($this->scope)->name;

        return ($target && $scope) ?
            $target .' - '. $scope : null;
    }

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
     * @return BelongsTo
     */
    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    /**
     * @return BelongsTo
     */
    public function deck(): BelongsTo
    {
        return $this->belongsTo(Deck::class);
    }

    /**
     * @return BelongsTo
     */
    public function target(): BelongsTo
    {
        return $this->belongsTo(Card::class, 'card_id');
    }

    /**
     * @return BelongsTo
     */
    public function scope(): BelongsTo
    {
        return $this->belongsTo(Card::class, 'scope_id');
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
}
