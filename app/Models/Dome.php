<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use App\Models\Traits\Cards;
use App\Models\Traits\Decks;
use App\Models\Traits\Sources;

/**
 * @property int|null $card_id
 * @property int|null $area_width
 * @property int|null $area_height
 * @property int|null $map_width
 * @property int|null $map_height
 * @property int|null $top_step
 * @property int|null $left_step
 * @property array|null $area_mask
 *
 * @property-read string|null $card_image
 *
 * @property-read Card|null $dome
 * @property-read Land[]|null $lands
 * @property-read Area[]|null $areas
 * @property-read Book[]|null $books
 */
class Dome extends Content implements SpaceInterface
{
    use Cards, Decks, Sources;

    /**
     * @var string[]
     */
    protected $casts = [
        'area_mask' => 'array'
    ];

    /**
     * @return string|null
     */
    public function getCardImageAttribute(): ?string
    {
        return $this->dome?->image;
    }

    /**
     * @return BelongsTo
     */
    public function dome(): BelongsTo
    {
        return $this->belongsTo(Card::class, 'scope_id');
    }

    /**
     * @return HasMany
     */
    public function lands(): HasMany
    {
        return $this->hasMany(Land::class);
    }

    /**
     * @return HasMany
     */
    public function areas(): HasMany
    {
        return $this->hasMany(Area::class);
    }

    /**
     * @return BelongsToMany
     */
    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class);
    }

    /**
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function (Dome $dome) {
            $dome->owner()->associate(Auth::user());
        });
        static::saving(function (Dome $dome) {
            $dome->name = $dome->dome->name;
        });
    }
}
