<?php

namespace App\Models\Process;

/**
 * @property int[]|null $card_ids
 * @property int[]|null $source_ids
 * @property int[]|null $deck_ids
 * @property int[]|null $dome_ids
 */
class BookProcess extends Process
{
    protected $collection = 'books';

    protected $fillable = [
        'id',
        'name',
        'image',
        'desc',
        'source_ids',
        'dome_ids',
        'deck_ids'
    ];
}
