<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int|null $id
 * @property string|null $name
 * @property string|null $desc
 * @property int|null $book_id
 * @property int|null $master_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Book|null $book
 * @property-read User|null $master
 * @property-read User[]|null $players
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
}
