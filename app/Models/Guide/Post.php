<?php

namespace App\Models\Guide;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
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
 * @property Topic|null $category
 * @property Link[]|Collection $targetLinks
 *
 * @property-read string|null $title
 */
class Post extends GuideItem
{
    use BelongsToProject, BelongsToTopic, HasNotes;

    protected $table = 'posts';

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
    public function category(): BelongsTo
    {
        return $this->belongsTo(Topic::class, 'category_id');
    }

    /**
     * @return HasMany
     */
    public function targetLinks(): HasMany
    {
        return $this->hasMany(Link::class, 'target_post_id');
    }
}
