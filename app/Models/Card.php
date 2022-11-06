<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Traits\Tags;
use App\Models\Traits\Decks;
use App\Models\Traits\Owner;

/**
 * @property int|null $id
 * @property int|null $scope_id
 * @property string|null $private_desc
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Scope|null $scope
 * @property-read Tag[]|null $tags
 * @property-read Deck[]|null $decks
 */
class Card extends Content
{
    use HasFactory, Tags, Decks, Owner;

    /**
     * @var array|string[]
     */
    public array $translatable = ['name', 'desc', 'private_desc'];

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
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'tag_card');
    }

    /**
     * @return BelongsToMany
     */
    public function decks(): BelongsToMany
    {
        return $this->belongsToMany(Deck::class, 'card_deck');
    }

    /**
     * @return array
     */
    public function export(): array
    {
        $data = parent::export();
        $data['scope'] = optional($this->scope)->name;
        $data['decks'] = $this->decks()->get()->pluck('name')->toArray();

        return $data;
    }
}
