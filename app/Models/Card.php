<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Traits\Tags;
use App\Models\Traits\Decks;
use App\Models\Traits\Books;

/**
 * @property-read Card[]|null $tags
 * @property-read Decks[]|null $decks
 * @property-read Decks[]|null $inDecks
 * @property-read Books[]|null $books
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
        return $this->belongsToMany(
            Card::class,
            'card_tag',
            'card_id',
            'tag_id'
        );
    }

    /**
     * @return BelongsToMany
     */
    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'book_card');
    }

    /**
     * @return BelongsToMany
     */
    public function inDecks(): BelongsToMany
    {
        return $this->belongsToMany(
            Deck::class,
            'deck_card',
        )->withPivot('count');
    }

    /**
     * @return HasMany
     */
    public function decks(): HasMany
    {
        return $this->hasMany(Deck::class);
    }

    /**
     * @return array
     */
    public function export(): array
    {
        $data = parent::export();
        $data['scope'] = optional($this->scope)->name;
        $data['decks'] = $this->decks()->get()->pluck('name')->toArray();
        $data['in_decks'] = $this->inDecks()->get()->pluck('name')->toArray();

        return $data;
    }
}
