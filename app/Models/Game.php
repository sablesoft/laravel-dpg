<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Service\Shuffler;

/**
 * @property int|null $id
 * @property string|null $name
 * @property string|null $desc
 * @property int|null $book_id
 * @property int|null $master_id
 * @property int|null $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Book|null $book
 * @property-read User|null $master
 * @property-read User[]|null $players
 * @property-read Stack[]|null $stacks
 * @property-read Log[]|null $logs
 * @property-read Card[]|null $board
 */
class Game extends Model
{
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
    public function master(): BelongsTo
    {
        return $this->belongsTo(User::class, 'master_id');
    }

    /**
     * @return BelongsToMany
     */
    public function players(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'game_player',
            'game_id',
            'player_id'
        );
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

    public static function boot()
    {
        parent::boot();
        self::created(function(Game $model) {
            $model->refresh();
            $decks = optional($model->book)->decks()->where('type', Deck::TYPE_STACK)->get();
            if ($decks) {
                /** @var Deck $deck */
                foreach ($decks as $deck) {
                    $stack = new Stack();
                    $stack->game_id = $model->getKey();
                    $stack->deck_id = $deck->getKey();
                    $stack = Shuffler::init($stack);
                    $stack->save();
                }
            }
        });
    }
}
