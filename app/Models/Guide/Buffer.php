<?php

namespace App\Models\Guide;

use Carbon\Carbon;

/**
 * @property int|null $id
 * @property string|null $text
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Buffer extends GuideItem
{
    use BelongsToProject;

    protected $table = 'guide_buffers';

    protected $fillable = [
        'text',
        'project_id',
        'owner_id'
    ];
}
