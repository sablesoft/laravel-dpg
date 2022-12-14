<?php

namespace App\Models\Process;

/**
 * @property string|null $image
 * @property int|null $scope_id
 * @property int|null $dome_id
 * @property int|null $top
 * @property int|null $left
 * @property int|null $top_step
 * @property int|null $left_step
 * @property int[]|null $scene_ids
 * @property array|null $markers
 */
class AreaProcess extends Process implements SpaceProcessInterface
{
    protected $collection = 'areas';

    protected $fillable = [
        'id',
        'name',
        'currentName',
        'desc',
        'currentDesc',
        'image',
        'scope_id',
        'dome_id',
        'top',
        'left',
        'top_step',
        'left_step',
        'canvas',
        'markers',
        'source_ids',
        'scene_ids',
        'card_ids',
        'deck_ids'
    ];
}
