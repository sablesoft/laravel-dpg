<?php

namespace App\Models;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Service\Shuffler;
use App\Models\Traits\Owner;
use App\Models\Traits\FromDeck;

/**
 * @property array|null $pack
 * @property array|null $discard
 *
 * @property-read int|null $pack_size
 * @property-read int|null $discard_size
 *
 * @property-read Log|null $logs
 */
class Stack extends Model
{
    use FromDeck, Owner;

    /**
     * @var string[]
     */
    protected $casts = [
        'pack' => 'array',
        'discard' => 'array',
    ];

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
     * @return HasMany
     */
    public function logs(): HasMany
    {
        return $this->hasMany(Log::class);
    }

    /**
     * @param Game $game
     * @param Deck $deck
     * @return static
     * @throws Exception
     */
    public static function createFromDeck(Game $game, Deck $deck): static
    {
        /** @var Stack $stack */
        $stack = static::prepareFromDeck($game, $deck, Deck::TYPE_STACK);
        $stack = Shuffler::init($stack);
        $stack->save();

        return $stack;
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function (Stack $stack) {
            $stack->owner()->associate(Auth::user());
        });
    }
}
