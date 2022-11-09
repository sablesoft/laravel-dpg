<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Traits\Decks;
use App\Models\Traits\Adventures;

/**
 * @property-read Tag[]|null $nested
 * @property-read Deck[]|null $decks
 * @property-read Deck[]|null $scopedDecks
 * @property-read Card[]|null $cards
 * @property-read Card[]|null $scopedCards
 * @property-read Adventures[]|null $adventures
 * @property-read Adventures[]|null $scopedAdventures
 */
class Tag extends Content
{
    use HasFactory, Decks, Adventures;

    /**
     * @return HasMany
     */
    public function nested(): HasMany
    {
        return $this->hasMany(Tag::class, 'scope_id');
    }

    /**
     * @return BelongsToMany
     */
    public function decks(): BelongsToMany
    {
        return $this->belongsToMany(Deck::class, 'tag_deck');
    }

    /**
     * @return HasMany
     */
    public function scopedDecks(): HasMany
    {
        return $this->hasMany(Deck::class, 'scope_id');
    }

    /**
     * @return BelongsToMany
     */
    public function cards(): BelongsToMany
    {
        return $this->belongsToMany(Card::class, 'tag_card');
    }

    /**
     * @return HasMany
     */
    public function scopedCards(): HasMany
    {
        return $this->hasMany(Card::class, 'scope_id');
    }

    /**
     * @return BelongsToMany
     */
    public function adventures(): BelongsToMany
    {
        return $this->belongsToMany(Adventure::class, 'tag_adventure');
    }

    /**
     * @return HasMany
     */
    public function scopedAdventures(): HasMany
    {
        return $this->hasMany(Adventure::class, 'scope_id');
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
        $data['nested'] = $this->nested()->get()->pluck('name')->toArray();
        $data['decks'] = $this->decks()->get()->pluck('name')->toArray();
        $data['scopedDecks'] = $this->scopedDecks()->get()->pluck('name')->toArray();
        $data['cards'] = $this->cards()->get()->pluck('name')->toArray();
        $data['scopedCards'] = $this->scopedCards()->get()->pluck('name')->toArray();
        $data['adventures'] = $this->adventures()->get()->pluck('name')->toArray();
        $data['scopedAdventures'] = $this->scopedAdventures()->get()->pluck('name')->toArray();

        return $data;
    }
}
