<?php

namespace App\Models\Guide;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int|null $id
 * @property int|null $project_id
 * @property int|null $post_id
 * @property int|null $topic_id
 * @property string|null $text
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Link[]|Collection $targetLinks
 *
 * @property-read string|null $title
 */
class Note extends GuideItem
{
    use BelongsToProject, BelongsToTopic, BelongsToPost, HasLinks;

    protected $table = 'guide_notes';

    protected $fillable = [
        'topic_id',
        'project_id',
        'post_id',
        'text'
    ];

    /**
     * @return string|null
     */
    public function getTitleAttribute(): ?string
    {
        $targetName = $this->project ? $this->project->code: optional($this->post)->title;
        $topicName = optional($this->topic)->name;

        return $targetName && $topicName ? "$targetName - $topicName" : null;
    }

    /**
     * @return HasMany
     */
    public function targetLinks(): HasMany
    {
        return $this->hasMany(Link::class, 'target_note_id');
    }
}
