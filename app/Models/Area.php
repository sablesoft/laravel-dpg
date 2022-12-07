<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;
use App\Models\Traits\Decks;
use App\Models\Traits\Sources;

/**
 * @property int|null $dome_id
 * @property int|null $card_id
 * @property string|null $filename
 * @property int|null $top_step
 * @property int|null $top
 * @property int|null $left_step
 * @property int|null $left
 * @property array|null $markers
 *
 * @property-read string|null $card_image
 * @property-read string|null $dome_image
 *
 * @property-read Dome|null $dome
 * @property-read Card|null $area
 * @property-read Card[]|null $cards
 */
class Area extends Content
{
    use Decks, Sources;

    /**
     * @return BelongsTo
     */
    public function dome(): BelongsTo
    {
        return $this->belongsTo(Dome::class);
    }

    /**
     * @return string|null
     */
    public function getCardImageAttribute(): ?string
    {
        return $this->area?->image;
    }

    /**
     * @return string|null
     */
    public function getDomeImageAttribute(): ?string
    {
        return $this->dome?->card_image;
    }

    /**
     * @return BelongsTo
     */
    public function area(): BelongsTo
    {
        return $this->belongsTo(Card::class, 'card_id');
    }

    /**
     * @return BelongsToMany
     */
    public function cards(): BelongsToMany
    {
        return $this->belongsToMany(Card::class, 'card_relation');
    }

    /**
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::saving(function (Area $area) {
            $area->name = $area->area->name;
            $area->owner()->associate(Auth::user());
        });
    }
}
