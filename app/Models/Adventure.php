<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Traits\Tags;
use App\Models\Traits\Decks;
use App\Models\Traits\Owner;

/**
 * @property int|null $id
 * @property string|null $name
 * @property string|null $desc
 * @property int|null $owner_id
 * @property bool|null $is_public
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Tag[]|null $tags
 * @property-read Deck[]|null $decks
 */
class Adventure extends Content
{
    use HasFactory, Tags, Decks, Owner;

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
}
