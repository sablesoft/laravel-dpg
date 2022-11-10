<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Traits\Tags;

/**
 * @property-read Tag[]|null $tags
 * @property-read Card[]|null $cards
 */
class Book extends Content
{
    use HasFactory, Tags;

    /**
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'book_tag');
    }

    /**
     * @return BelongsToMany
     */
    public function cards(): BelongsToMany
    {
        return $this->belongsToMany(Card::class, 'book_card');
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
