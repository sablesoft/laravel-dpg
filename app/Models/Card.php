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
 * @property-read Card[]|null $scopedCards
 * @property-read Deck[]|null $scopedDecks
 * @property-read Card[]|null $taggedCards
 *
 * @property-read object|null pivot
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
     * @return HasMany
     */
    public function scopedCards(): HasMany
    {
        return $this->hasMany(Card::class, 'scope_id');
    }

    /**
     * @return BelongsToMany
     */
    public function taggedCards(): BelongsToMany
    {
        return $this->belongsToMany(
            Card::class,
            'card_tag',
            'tag_id',
            'card_id'
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
     * @return HasMany
     */
    public function scopedDecks(): HasMany
    {
        return $this->hasMany(Deck::class, 'scope_id');
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

    /**
     * @param Card $scope
     * @param Card $card
     * @return bool
     */
    public static function validateScope(Card $scope, Card $card): bool
    {
        if (!$card->scope) {
            return false;
        }

        if ($card->scope->getKey() !== $scope->getKey()) {
            return static::validateScope($scope, $card->scope);
        } else {
            return true;
        }
    }
}
