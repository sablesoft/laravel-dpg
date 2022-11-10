<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Traits\Books;

/**
 * @property-read Tag[]|null $nested
 * @property-read Card[]|null $cards
 * @property-read Card[]|null $scopedCards
 * @property-read Books[]|null $books
 * @property-read Books[]|null $scopedBooks
 */
class Tag extends Content
{
    use HasFactory, Books;

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
    public function cards(): BelongsToMany
    {
        return $this->belongsToMany(Card::class, 'card_tag');
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
    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'book_tag');
    }

    /**
     * @return HasMany
     */
    public function scopedBooks(): HasMany
    {
        return $this->hasMany(Book::class, 'scope_id');
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
        $data['cards'] = $this->cards()->get()->pluck('name')->toArray();
        $data['scopedCards'] = $this->scopedCards()->get()->pluck('name')->toArray();
        $data['books'] = $this->books()->get()->pluck('name')->toArray();
        $data['scopedBooks'] = $this->scopedBooks()->get()->pluck('name')->toArray();

        return $data;
    }
}
