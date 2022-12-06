<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use App\Models\Traits\Decks;

/**
 * @property int|null $card_id
 * @property int|null $area_width
 * @property int|null $area_height
 * @property int|null $top_step
 * @property int|null $left_step
 * @property array|null $area_mask
 *
 * @property-read string|null $card_image
 *
 * @property-read Card|null $dome
 * @property-read Area[]|null $areas
 * @property-read Card[]|null $cards
 * @property-read Book[]|null $sources
 * @property-read Book[]|null $books
 */
class Dome extends Content
{
    use Decks;

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
        return $this->belongsTo(Card::class, 'card_id');
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
    public function cards(): BelongsToMany
    {
        return $this->belongsToMany(Card::class, 'dome_card');
    }

    /**
     * @return BelongsToMany
     */
    public function sources(): BelongsToMany
    {
        return $this->belongsToMany(
            Book::class,
            'dome_source',
            'dome_id',
            'source_id'
        );
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
