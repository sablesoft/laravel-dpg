<?php

namespace App\Models\Process;

use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Relations\BelongsTo;

/**
 * @property int|null $id
 * @property string|null $name
 * @property string|null $desc
 * @property-read GameProcess|null $game
 */
abstract class Process extends Model
{
    const GAME_FOREIGN_KEY = 'game_process_id';

    protected $connection = 'mongodb';

    protected $hidden = [
        '_id',
        'created_at',
        'updated_at',
        'game',
        self::GAME_FOREIGN_KEY
    ];

    /**
     * @return BelongsTo
     */
    public function game(): BelongsTo
    {
        return $this->belongsTo(GameProcess::class, static::GAME_FOREIGN_KEY);
    }

    /**
     * @return string[]
     */
    public static function collections(): array
    {
        return [
            'books', 'cards', 'decks', 'domes', 'areas', 'lands', 'scenes'
        ];
    }
}
