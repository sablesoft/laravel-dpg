<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Traits\Cards;
use App\Models\Traits\Decks;
use App\Models\Traits\Scenes;
use App\Models\Traits\Sources;

/**
 * @property-read string|null $dome_image
 * @property-read string|null $card_image
 *
 * @property-read Card|null $card
 * @property-read Dome|null $dome
 * @property-read Area[]|null $areas
 */
class Land extends Content implements SpaceInterface
{
    use Cards, Decks, Sources, Scenes;

    /**
     * @return BelongsTo
     */
    public function card(): BelongsTo
    {
        return $this->belongsTo(Card::class, 'scope_id');
    }

    /**
     * @return string|null
     */
    public function getCardImageAttribute(): ?string
    {
        return $this->card?->image;
    }

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
    public function getDomeImageAttribute(): ?string
    {
        return $this->dome?->card_image;
    }

    /**
     * @return BelongsToMany
     */
    public function areas(): BelongsToMany
    {
        return $this->belongsToMany(Area::class, 'land_area');
    }

    /**
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::saving(function (Land $land) {
            $land->name = $land->card->name;
        });
    }
}
