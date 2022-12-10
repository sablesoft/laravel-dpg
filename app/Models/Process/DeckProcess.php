<?php

namespace App\Models\Process;

/**
 * @property int|null $target_id
 * @property int|null $scope_id
 * @property int|null $type
 * @property string|null $image
 * @property int[]|null $cards
 */
class DeckProcess extends Process
{
    protected $collection = 'decks';

    protected $fillable = [
        'id',
        'type',
        'image',
        'desc',
        'target_id',
        'scope_id',
        'cards'
    ];
}
