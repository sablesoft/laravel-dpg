<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Traits\Tags;
use App\Models\Traits\Decks;

/**
 * @property-read Tag[]|null $tags
 * @property-read Deck[]|null $decks
 */
class Adventure extends Content
{
    use HasFactory, Tags, Decks;

    /**
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'tag_adventure');
    }

    /**
     * @return BelongsToMany
     */
    public function decks(): BelongsToMany
    {
        return $this->belongsToMany(Deck::class, 'deck_adventure');
    }

    /**
     * @return array
     */
    public function export(): array
    {
        $data = parent::export();
        $data['decks'] = $this->decks()->get()->pluck('name')->toArray();

        return $data;
    }
}
