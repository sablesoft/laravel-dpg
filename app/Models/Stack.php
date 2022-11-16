<?php

namespace App\Models;

use Exception;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Service\Shuffler;
use App\Models\Traits\FromDeck;

/**
 * @property int|null $id
 * @property int|null $game_id
 * @property int|null $deck_id
 * @property int|null $card_id
 * @property int|null $scope_id
 * @property string|null $desc
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
 * @property-read Card|null $card
 * @property-read Card|null $scope
 * @property-read Log|null $logs
 */
class Stack extends Model
{
    use FromDeck;

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
     * @return BelongsTo
     */
    public function target(): BelongsTo
    {
        return $this->belongsTo(Card::class, 'card_id');
    }

    /**
     * @return BelongsTo
     */
    public function scope(): BelongsTo
    {
        return $this->belongsTo(Card::class, 'scope_id');
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
}
