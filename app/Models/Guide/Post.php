<?php

namespace App\Models\Guide;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int|null $id
 * @property string|null $desc
 * @property int|null $project_id
 * @property int|null $category_id
 * @property int|null $topic_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Topic|null $category
 * @property Link[]|Collection $targetLinks
 */
class Post extends GuideItem
{
    use BelongsToProject, BelongsToTopic, HasNotes;

    protected $table = 'guide_posts';

    protected $fillable = [
        'desc',
        'topic_id',
        'category_id',
        'project_id',
    ];

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
