<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;
use App\Enums\GameStatus;
use App\Models\Traits\Owner;
use App\Models\Traits\Subscribers;

/**
 * @property int|null $id
 * @property string|null $name
 * @property string|null $desc
 * @property int|null $quest_id
 * @property int|null $owner_id
 * @property bool|null $is_public
 * @property string|null $board_image
 * @property GameStatus|null $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read int|null $status_value
 *
 * @property-read Book[]|null $books
 * @property-read Card[]|null $heroes
 * @property-read Card|null $quest
 * @property-read Stack[]|null $stacks
 * @property-read Set[]|null $sets
 * @property-read State[]|null $states
 * @property-read Story[]|null $stories
 */
class Game extends Model
{
    use HasTranslations, Subscribers, Owner;

    const SUBSCRIBER_TYPE_PLAYER = 0;
    const SUBSCRIBER_TYPE_SPECTATOR = 1;

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
    public function stacks(): HasMany
    {
        return $this->hasMany(Stack::class);
    }

    /**
     * @return HasMany
     */
    public function sets(): HasMany
    {
        return $this->hasMany(Set::class);
    }

    /**
     * @return HasMany
     */
    public function states(): HasMany
    {
        return $this->hasMany(State::class);
    }

    /**
     * @return HasMany
     */
    public function stories(): HasMany
    {
        return $this->hasMany(Story::class);
    }

    /**
     * @return array
     */
    public static function subscriberTypeOptions(): array
    {
        return [
            self::SUBSCRIBER_TYPE_PLAYER => __('Player'),
            self::SUBSCRIBER_TYPE_SPECTATOR => __('Spectator'),
        ];
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function (Game $game) {
            $game->owner()->associate(Auth::user());
        });
    }
}
