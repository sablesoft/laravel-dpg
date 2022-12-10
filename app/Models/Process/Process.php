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
    protected $connection = 'mongodb';

    protected $hidden = [
        '_id',
        'created_at',
        'updated_at',
        'game',
        'game_process_id'
    ];

    /**
     * @return BelongsTo
     */
    public function game(): BelongsTo
    {
        return $this->belongsTo(GameProcess::class, 'game_process_id');
    }
}
