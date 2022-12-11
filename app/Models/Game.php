<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use App\Enums\GameStatus;
use App\Models\Traits\Cards;
use App\Models\Traits\Decks;
use App\Models\Traits\Owner;
use App\Models\Traits\Subscribers;
use App\Models\Process\GameProcess;

/**
 * @property int|null $id
 * @property string|null $name
 * @property string|null $image
 * @property string|null $desc
 * @property int|null $quest_id
 * @property int|null $owner_id
 * @property bool|null $is_public
 * @property string|null $board_image
 * @property string|null $cards_back
 * @property GameStatus|null $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read int|null $status_value
 *
 * @property-read Book[]|null $books
 * @property-read Card[]|null $heroes
 * @property-read Card|null $quest
 * @property-read Story[]|null $stories
 * @property-read GameProcess|null $process
 */
class Game extends Model
{
    use HasTranslations, Subscribers,
        Owner, HybridRelations, Cards, Decks;

    protected $casts = [
        'status' => GameStatus::class
    ];

    /**
     * @var array|string[]
     */
    public array $translatable = ['name', 'desc'];

    /**
     * @return int|null
     */
    public function getStatusValueAttribute(): ?int
    {
        return $this->status?->value;
    }

    /**
     * @return BelongsTo
     */
    public function process(): BelongsTo
    {
        return $this->belongsTo(GameProcess::class, 'process_id');
    }

    /**
     * @return BelongsToMany
     */
    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'game_book');
    }

    /**
     * @return BelongsToMany
     */
    public function heroes(): BelongsToMany
    {
        return $this->belongsToMany(
            Card::class,
            'game_hero',
            'game_id',
            'hero_id'
        );
    }

    /**
     * @return BelongsTo
     */
    public function quest(): BelongsTo
    {
        return $this->belongsTo(Card::class, 'quest_id');
    }

    /**
     * @return BelongsToMany
     */
    public function subscribers(): BelongsToMany
    {
        return $this->_subscribers('game');
    }

    /**
     * @return HasMany
     */
    public function stories(): HasMany
    {
        return $this->hasMany(Story::class);
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function (Game $game) {
            $game->owner()->associate(Auth::user());
        });
    }
}
