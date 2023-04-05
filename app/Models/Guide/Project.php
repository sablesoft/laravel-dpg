<?php

namespace App\Models\Guide;

use Carbon\Carbon;

/**
 * @property int|null $id
 * @property string|null $name
 * @property string|null $code
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Project extends GuideItem
{
    use HasNotes, HasPosts, HasTopics;

    protected $table = 'guide_projects';

    protected $fillable = [
        'name',
        'code',
        'owner_id'
    ];
}
