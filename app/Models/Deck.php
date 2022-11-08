<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Traits\Tags;
use App\Models\Traits\Adventures;

/**
 * @property-read Tag[]|null $tags
 * @property-read Card[]|null $cards
 * @property-read Adventure[]|null $adventures
 */
class Deck extends Content
{
    use HasFactory, Tags, Adventures;

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
        return $this->belongsToMany(Card::class, 'card_deck')
            ->withPivot('count');
    }

    /**
     * @return BelongsToMany
     */
    public function adventures(): BelongsToMany
    {
        return $this->belongsToMany(Adventure::class, 'deck_adventure');
    }

    /**
     * @return array
     */
    public function export(): array
    {
        $data = parent::export();
        $data['cards'] = $this->cards()->get()->pluck('name')->toArray();

        return $data;
    }
}
