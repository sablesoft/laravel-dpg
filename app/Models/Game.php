<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Spatie\Translatable\HasTranslations;

/**
 * @property int|null $id
 * @property string|null $name
 * @property string|null $desc
 * @property int|null $book_id
 * @property int|null $hero_id
 * @property int|null $quest_id
 * @property int|null $master_id
 * @property bool|null $is_public
 * @property string|null $board_image
 * @property int|null $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read string|null $prepared_name
 *
 * @property-read Book|null $book
 * @property-read Card|null $hero
 * @property-read Card|null $quest
 * @property-read User|null $master
 * @property-read User[]|null $subscribers
 * @property-read Stack[]|null $stacks
 * @property-read Set[]|null $sets
 * @property-read Unique[]|null $uniques
 * @property-read Log[]|null $logs
 * @property-read Card[]|null $board
 *
 * @method Builder allowedToSee() static
 */
class Game extends Model
{
    use HasTranslations;

    const SUBSCRIBER_TYPE_PLAYER = 0;
    const SUBSCRIBER_TYPE_SPECTATOR = 1;

    /**
     * @var array|string[]
     */
    public array $translatable = ['name', 'desc'];

    /**
     * @return string|null
     */
    public function getPreparedNameAttribute(): ?string
    {
        if ($name = $this->name) {
            return $name;
        }

        return optional($this->book)->name;
    }

    /**
     * @return BelongsTo
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * @return BelongsTo
     */
    public function hero(): BelongsTo
    {
        return $this->belongsTo(Card::class, 'hero_id');
    }

    /**
     * @return BelongsTo
     */
    public function quest(): BelongsTo
    {
        return $this->belongsTo(Card::class, 'quest_id');
    }

    /**
     * @return BelongsTo
     */
    public function master(): BelongsTo
    {
        return $this->belongsTo(User::class, 'master_id');
    }

    /**
     * @return BelongsToMany
     */
    public function subscribers(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'game_subscriber',
            'game_id',
            'subscriber_id'
        )->withPivot(['type']);
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
    public function uniques(): HasMany
    {
        return $this->hasMany(Unique::class);
    }

    /**
     * @return HasMany
     */
    public function logs(): HasMany
    {
        return $this->hasMany(Log::class);
    }

    /**
     * @return BelongsToMany
     */
    public function board(): BelongsToMany
    {
        return $this->belongsToMany(
            Card::class,
            'game_card',
            'game_id',
            'card_id'
        );
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeAllowedToSee(Builder $query): Builder
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user->isAdmin()) {
            return $query;
        }

        $query->where('is_public', true)
            ->orWhere(function($query) use ($user) {
                return $query->whereHas('subscribers', function($query) use ($user) {
                    $query->where('subscriber_id', $user->getKey());
                });
            });

        return $query;
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
        self::created(function(Game $model) {
            $model->refresh();
            $decks = optional($model->book)->decks;
            if ($decks) {
                /** @var Deck $deck */
                foreach ($decks as $deck) {
                    switch ($deck->type) {
                        case Deck::TYPE_STACK:
                            Stack::createFromDeck($model, $deck);
                            break;
                        case Deck::TYPE_SET:
                            Set::createFromDeck($model, $deck);
                            break;
                        case Deck::TYPE_UNIQUE:
                            Unique::createFromDeck($model, $deck);
                            break;
                        default:
                            break;
                    }
                }
            }
        });
    }
}
