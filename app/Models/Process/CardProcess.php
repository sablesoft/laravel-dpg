<?php

namespace App\Models\Process;

/**
 * @property string|null $code
 * @property int|null $scope_id
 * @property string|null $image
 * @property string|null $scope_name
 * @property string|null $scope_image
 * @property string|null $current_name
 * @property string|null $current_desc
 * @property-read CardProcess|null $scope
 */
class CardProcess extends Process
{
    protected $collection = 'cards';

    protected $fillable = [
        'id',
        'name',
        'current_name',
        'code',
        'scope_id',
        'image',
        'desc',
        'current_desc',
        'scope_name',
        'scope_image'
    ];
}
