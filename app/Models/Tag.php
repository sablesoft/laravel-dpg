<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Traits\Decks;
use App\Models\Traits\Adventures;

/**
 * @property int|null $id
 * @property int|null $scope_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Scope|null $scope
 * @property-read Deck[]|null $decks
 * @property-read Card[]|null $cards
 */
class Tag extends Content
{
    use HasFactory, Decks, Adventures;

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

    /**
     * @return BelongsToMany
     */
    public function adventures(): BelongsToMany
    {
        return $this->belongsToMany(Adventure::class, 'tag_adventure');
    }

    /**
     * @return array
     */
    public function export(): array
    {
        $data = [];
        $map = ['name', 'desc', 'is_public'];
        foreach ($map as $key) {
            $data[$key] = $this->$key;
        }
        $data['scope'] = optional($this->scope)->name;
        $data['decks'] = $this->decks()->get()->pluck('name')->toArray();
        $data['cards'] = $this->cards()->get()->pluck('name')->toArray();

        return $data;
    }
}
