<?php

namespace App\Models\Guide;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
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
 * @property Project|null $project
 * @property Post|null $post
 * @property Topic|null $topic
 * @property Link[]|null $links
 * @property Link[]|null $targetLinks
 *
 * @property-read string|null $title
 */
class Note extends Model
{
    protected $table = 'guide_notes';

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
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * @return BelongsTo
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * @return BelongsTo
     */
    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    /**
     * @return HasMany
     */
    public function links(): HasMany
    {
        return $this->hasMany(Link::class);
    }

    /**
     * @return HasMany
     */
    public function targetLinks(): HasMany
    {
        return $this->hasMany(Link::class, 'target_note_id');
    }
}
