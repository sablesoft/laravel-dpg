<?php

namespace App\Models\Guide;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int|null $id
 * @property int|null $project_id
 * @property int|null $post_id
 * @property int|null $topic_id
 * @property string|null $content
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Post|null $post

 * @property Link[]|Collection $targetLinks
 *
 * @property-read string|null $title
 */
class Note extends GuideItem
{
    use BelongsToProject, BelongsToTopic, HasLinks;

    protected $table = 'guide_notes';

    protected $fillable = [
        'topic_id',
        'project_id',
        'post_id',
        'content'
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
     * @return BelongsTo
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * @return HasMany
     */
    public function targetLinks(): HasMany
    {
        return $this->hasMany(Link::class, 'target_note_id');
    }
}
