<?php

namespace App\Models;


use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Traits\Cards;
use App\Models\Traits\Decks;
use App\Models\Traits\Sources;

/**
 * @property string|null $code
 * @property array|null $markers
 *
 * @property-read Card|null $scene
 * @property-read Book[]|null $books
 * @property-read Dome[]|null $domes
 * @property-read Land[]|null $lands
 * @property-read Area[]|null $areas
 *
 * @property-read string|null $card_image
 */
class Scene extends Content implements SpaceInterface
{
    use Sources, Decks, Cards;

    protected $casts = [
        'markers' => 'array'
    ];

    /**
     * @var array|string[]
     */
    public array $translatable = ['desc'];

    /**
     * @return string|null
     */
    public function getCardImageAttribute(): ?string
    {
        return $this->scene?->image;
    }

    /**
     * @return BelongsTo
     */
    public function scene(): BelongsTo
    {
        return $this->belongsTo(Card::class, 'scope_id');
    }

    /**
     * @return BelongsToMany
     */
    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'scene_relation');
    }

    /**
     * @return BelongsToMany
     */
    public function domes(): BelongsToMany
    {
        return $this->belongsToMany(Dome::class, 'scene_relation');
    }

    /**
     * @return BelongsToMany
     */
    public function lands(): BelongsToMany
    {
        return $this->belongsToMany(Land::class, 'scene_relation');
    }

    /**
     * @return BelongsToMany
     */
    public function areas(): BelongsToMany
    {
        return $this->belongsToMany(Area::class, 'scene_relation');
    }

    /**
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function(Scene $scene) {
            $scene->owner()->associate(Auth::user());
        });
        static::saving(function (Scene $scene) {
            $scene->name = $scene->scope->name;
        });
    }
}
