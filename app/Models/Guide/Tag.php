<?php

namespace App\Models\Guide;

use Carbon\Carbon;

/**
 * @property int|null $id
 * @property int|null $post_id
 * @property int|null $topic_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read string|null $title
 */
class Tag extends GuideItem
{
    use BelongsToProject, BelongsToTopic, BelongsToPost;

    protected $table = 'guide_tags';

    protected $fillable = [
        'topic_id',
        'project_id',
        'post_id',
    ];

    /**
     * @return string|null
     */
    public function getTitleAttribute(): ?string
    {
        return optional($this->topic)->name;
    }
}
