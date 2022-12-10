<?php

namespace App\Models;


use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Traits\Cards;
use App\Models\Traits\Decks;
use App\Models\Traits\Sources;

/**
 * @property string|null $code
 * @property array|null $markers
 *
 * @property-read Card|null $scene
 *
 * @property-read string|null $card_image
 */
class Scene extends Content
{
    use Sources, Decks, Cards;

    protected $casts = [
        'markers' => 'array'
    ];

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
