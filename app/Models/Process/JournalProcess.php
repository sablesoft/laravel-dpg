<?php

namespace App\Models\Process;

/**
 * @property string|null $code
 * @property string|null $type
 * @property int[]|null $author_id
 * @property int[]|null $created_at
 * @property int[]|null $updated_at
 */
class JournalProcess extends Process
{
    protected $collection = 'journals';

    protected $hidden = [
        '_id',
        'updated_at',
        'game',
        self::GAME_FOREIGN_KEY
    ];

    protected $fillable = [
        'id',
        'code',
        'type',
        'name',
        'desc',
        'author_id',
        self::GAME_FOREIGN_KEY
    ];
}
