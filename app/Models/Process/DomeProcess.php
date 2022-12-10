<?php

namespace App\Models\Process;

/**
 * @property string|null $image
 * @property int|null $scope_id
 * @property int|null $area_width
 * @property int|null $area_height
 * @property int|null $top_step
 * @property int|null $left_step
 * @property int[]|null $area_ids
 * @property int[]|null $land_ids
 */
class DomeProcess extends Process implements SpaceProcessInterface
{
    protected $collection = 'domes';

    protected $fillable = [
        'id',
        'name',
        'image',
        'scope_id',
        'area_width',
        'area_height',
        'top_step',
        'left_step',
        'desc',
        'source_ids',
        'card_ids',
        'deck_ids',
        'area_ids'
    ];
}
