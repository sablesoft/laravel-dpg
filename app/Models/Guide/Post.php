<?php

namespace App\Models\Guide;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int|null $id
 * @property int|null $project_id
 * @property int|null $category_id
 * @property int|null $topic_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Project|null $project
 * @property Topic|null $category
 * @property Topic|null $topic
 * @property Note[]|null $notes
 * @property Link[]|null $targetLinks
 *
 * @property-read string|null $title
 */
class Post extends Model
{
    protected $table = 'guide_posts';

    /**
     * @return string|null
     */
    public function getTitleAttribute(): ?string
    {
        $categoryName = $this->category?->name;
        $topicName = $this->topic?->name;

        return $categoryName && $topicName ? "$categoryName - $topicName" : null;
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
    public function category(): BelongsTo
    {
        return $this->belongsTo(Topic::class, 'category_id');
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
    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }

    /**
     * @return HasMany
     */
    public function targetLinks(): HasMany
    {
        return $this->hasMany(Link::class, 'target_post_id');
    }
}
