<?php

namespace App\Models\Process;

/**
 * @property string|null $image
 * @property int|null $scope_id
 * @property int|null $dome_id
 * @property int[]|null $area_ids
 */
class LandProcess extends Process implements SpaceProcessInterface
{
    protected $collection = 'lands';

    protected $fillable = [
        'id',
        'name',
        'desc',
        'image',
        'scope_id',
        'dome_id',
        'source_ids',
        'card_ids',
        'deck_ids',
        'area_ids'
    ];
}