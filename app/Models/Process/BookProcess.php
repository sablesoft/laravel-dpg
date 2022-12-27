<?php

namespace App\Models\Process;

/**
 * @property int[]|null $card_ids
 * @property int[]|null $source_ids
 * @property int[]|null $deck_ids
 * @property int[]|null $dome_ids
 * @property int[]|null $scene_ids
 * @property array|null $canvas
 */
class BookProcess extends Process
{
    protected $collection = 'books';

    protected $fillable = [
        'id',
        'name',
        'currentName',
        'image',
        'desc',
        'currentDesc',
        'source_ids',
        'dome_ids',
        'deck_ids',
        'scene_ids'
    ];
}
