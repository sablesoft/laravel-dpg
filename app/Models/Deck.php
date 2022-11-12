<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property-read Book|null $book
 * @property-read Card|null $target
 * @property-read Card[]|null $tags
 * @property-read Card[]|null $cards
 *
 * @property-read int[]|null $size
 */
class Deck extends Content
{
    /**
     * @return string|null
     */
    public function getNameAttribute(): ?string
    {
        $target = optional($this->target)->name;
        $scope = optional($this->scope)->name;

        return ($target && $scope) ?
            $target .' - '. $scope : null;
    }

    /**
     * @param $value
     * @return void
     */
    public function setNameAttribute($value)
    {
    }

    /**
     * @return BelongsTo
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * @return BelongsTo
     */
    public function target(): BelongsTo
    {
        return $this->belongsTo(Card::class, 'card_id');
    }

    /**
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(
            Card::class,
            'deck_tag',
            'deck_id',
            'tag_id'
        );
    }

    /**
     * @return BelongsToMany
     */
    public function cards(): BelongsToMany
    {
        return $this->belongsToMany(Card::class, 'deck_card')
            ->withPivot('count');
    }

    /**
     * @return int|null
     */
    public function getSizeAttribute(): ?int
    {
        return $this->cards()->sum('count') ?: null;
    }

    /**
     * @return array
     */
    public function export(): array
    {
        $data = parent::export();
        $data['scope'] = optional($this->scope)->name;
        $data['book'] = optional($this->book)->name;
        $data['target'] = optional($this->target)->name;
        $data['cards'] = $this->cards()->get()->pluck('name')->toArray();

        return $data;
    }
}
