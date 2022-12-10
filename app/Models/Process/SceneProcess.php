<?php

namespace App\Models\Process;

/**
 * @property string|null $image
 * @property int|null $scope_id
 * @property array|null $markers
 */
class SceneProcess extends Process implements SpaceProcessInterface
{
    protected $collection = 'scenes';

    protected $fillable = [
        'id',
        'name',
        'desc',
        'image',
        'scope_id',
        'markers',
        'source_ids',
        'card_ids',
        'deck_ids',
    ];
}
