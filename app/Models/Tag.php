<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Traits\Owner;
use App\Models\Traits\Decks;

/**
 * @property int|null $id
 * @property int|null $scope_id
 * @property string|null $name
 * @property string|null $desc
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Scope|null $scope
 * @property-read Deck[]|null $decks
 * @property-read Card[]|null $cards
 */
class Tag extends Model
{
    use HasFactory, Decks, Owner;

    /**
     * @return BelongsTo
     */
    public function scope(): BelongsTo
    {
        return $this->belongsTo(Scope::class);
    }

    /**
     * @return BelongsToMany
     */
    public function decks(): BelongsToMany
    {
        return $this->belongsToMany(Deck::class, 'tag_deck');
    }

    /**
     * @return BelongsToMany
     */
    public function cards(): BelongsToMany
    {
        return $this->belongsToMany(Card::class, 'tag_card');
    }
}
