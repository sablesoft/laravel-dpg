<?php

namespace App\Models\Process;

/**
 * @property string|null $code
 * @property string|null $info
 * @property int|null $scope_id
 * @property string|null $image
 * @property string|null $scopeName
 * @property string|null $scopeImage
 * @property string|null $currentName
 * @property string|null $currentDesc
 * @property array|null $canvas
 * @property-read CardProcess|null $scope
 */
class CardProcess extends Process
{
    protected $collection = 'cards';

    protected $fillable = [
        'id',
        'name',
        'currentName',
        'code',
        'scope_id',
        'image',
        'desc',
        'info',
        'currentDesc',
        'canvas',
        'scopeName',
        'scopeImage'
    ];
}
