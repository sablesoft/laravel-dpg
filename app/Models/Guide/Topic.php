<?php

namespace App\Models\Guide;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Traits\Owner;

/**
 * @property int|null $id
 * @property string|null $name
 * @property string|null $desc
 * @property int|null $project_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Project|null $project
 * @property Post[]|null $categoryPosts
 * @property Post[]|null $posts
 * @property Note[]|null $notes
 * @property Link[]|null $categoryLinks
 */
class Topic extends Model
{
    use Owner;

    protected $table = 'guide_topics';

    /**
     * @return BelongsTo
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

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
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
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
    public function categoryLinks(): HasMany
    {
        return $this->hasMany(Link::class, 'target_category_id');
    }

    /**
     * @return void
     */
    public static function boot(): void
    {
        parent::boot();

        static::creating(function (Topic $topic) {
            $topic->owner()->associate(Auth::user());
        });
    }
}
