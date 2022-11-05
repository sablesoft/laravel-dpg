<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Traits\Tags;
use App\Models\Traits\Owner;
use App\Models\Traits\Adventures;

/**
 * @property int|null $id
 * @property string|null $name
 * @property string|null $desc
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Tag[]|null $tags
 * @property-read Card[]|null $cards
 * @property-read Adventure[]|null $adventures
 */
class Deck extends Model
{
    use HasFactory, Tags, Adventures, Owner;

    /**
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'tag_deck');
    }

    /**
     * @return BelongsToMany
     */
    public function cards(): BelongsToMany
    {
        return $this->belongsToMany(Card::class, 'card_deck');
    }

    /**
     * @return BelongsToMany
     */
    public function adventures(): BelongsToMany
    {
        return $this->belongsToMany(Adventure::class, 'deck_adventure');
    }
}
