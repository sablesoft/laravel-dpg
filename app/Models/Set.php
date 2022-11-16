<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int|null $id
 * @property int|null $game_id
 * @property int|null $deck_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read string|null $name
 *
 * @property-read Game|null $game
 * @property-read Deck|null $deck
 * @property-read Card[]|null $cards
 */
class Set extends Model
{
    /**
     * @return string|null
     */
    public function getNameAttribute(): ?string
    {
        return optional($this->deck)->name;
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
     * @return BelongsToMany
     */
    public function cards(): BelongsToMany
    {
        return $this->belongsToMany(
            Card::class,
            'set_card'
        )->withPivot(['level', 'points']);
    }
}
