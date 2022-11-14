<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int|null $id
 * @property int|null $game_id
 * @property int|null $deck_id
 * @property array|null $pack
 * @property array|null $discard
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read string|null $name
 * @property-read int|null $pack_size
 * @property-read int|null $discard_size
 *
 * @property-read Game|null $game
 * @property-read Deck|null $deck
 * @property-read Log|null $logs
 */
class Stack extends Model
{
    /**
     * @var string[]
     */
    protected $casts = [
        'pack' => 'array',
        'discard' => 'array',
    ];

    /**
     * @return string|null
     */
    public function getNameAttribute(): ?string
    {
        return optional($this->deck)->name;
    }

    /**
     * @return int|null
     */
    public function getPackSizeAttribute(): ?int
    {
        return $this->pack ? count($this->pack): null;
    }

    /**
     * @return int|null
     */
    public function getDiscardSizeAttribute(): ?int
    {
        return $this->discard ? count($this->discard): null;
    }

    /**
     * @return BelongsTo
     */
    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    /**
     * @return BelongsTo
     */
    public function deck(): BelongsTo
    {
        return $this->belongsTo(Deck::class);
    }

    /**
     * @return HasMany
     */
    public function logs(): HasMany
    {
        return $this->hasMany(Log::class);
    }
}
