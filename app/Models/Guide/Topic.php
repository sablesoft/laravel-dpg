<?php

namespace App\Models\Guide;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int|null $id
 * @property string|null $name
 * @property string|null $text
 * @property int|null $project_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Post[]|Collection $categoryPosts
 * @property Link[]|Collection $categoryLinks
 */
class Topic extends GuideItem
{
    use HasNotes, HasPosts, BelongsToProject;

    protected $table = 'guide_topics';

    protected $fillable = [
        'name',
        'text',
        'project_id'
    ];

    /**
     * @return HasMany
     */
    public function categoryPosts(): HasMany
    {
        return $this->hasMany(Post::class, 'category_id');
    }

    /**
     * @return HasMany
     */
    public function categoryLinks(): HasMany
    {
        return $this->hasMany(Link::class, 'target_category_id');
    }
}
