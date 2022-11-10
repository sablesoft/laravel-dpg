<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Traits\Tags;
use App\Models\Traits\Decks;
use App\Models\Traits\Books;

/**
 * @property-read Tag[]|null $tags
 * @property-read Card[]|null $deck
 * @property-read Card[]|null $decks
 * @property-read Books[]|null $books
 *
 * @property-read Books[]|null $deck_size
 */
class Card extends Content
{
    use HasFactory, Tags, Decks, Books;

    /**
     * @var array|string[]
     */
    public array $translatable = ['name', 'desc'];

    /**
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'card_tag');
    }

    /**
     * @return BelongsToMany
     */
    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'book_card');
    }

    /**
     * @return int|null
     */
    public function getDeckSizeAttribute(): ?int
    {
        return $this->deck()->sum('count') ?: null;
    }

    /**
     * @return BelongsToMany
     */
    public function deck(): BelongsToMany
    {
        return $this->belongsToMany(
            Card::class,
            'decks',
            'deck_id',
            'card_id'
        )->withPivot('count');
    }

    /**
     * @return BelongsToMany
     */
    public function decks(): BelongsToMany
    {
        return $this->belongsToMany(
            Card::class,
            'decks',
            'card_id',
            'deck_id'
        )->withPivot('count');
    }

    /**
     * @return array
     */
    public function export(): array
    {
        $data = parent::export();
        $data['scope'] = optional($this->scope)->name;
        $data['deck'] = $this->deck()->get()->pluck('name')->toArray();

        return $data;
    }
}
