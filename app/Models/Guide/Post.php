<?php

namespace App\Models\Guide;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property int|null $id
 * @property string|null $text
 * @property int|null $number
 * @property int|null $category_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Topic|null $category
 * @property Link[]|Collection $targetLinks
 */
class Post extends GuideItem implements UseNumber
{
    use BelongsToProject, BelongsToModule, BelongsToTopic, HasNotes, HasLinks, HasTags;

    protected $table = 'guide_posts';

    protected $fillable = [
        'text',
        'number',
        'topic_id',
        'category_id',
        'project_id',
        'module_id'
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

    /**
     * @param int $categoryId
     * @param int|null $moduleId
     * @return int|null
     */
    public static function allowedNumber(int $categoryId, ?int $moduleId = null): ?int
    {
        $n = 1;
        $numbers = static::where('category_id', $categoryId)->where('module_id', $moduleId)
            ->pluck('number')->toArray();
        sort($numbers);
        foreach ($numbers as $number) {
            if ($number > $n) {
                return $n;
            }
            $n++;
        }

        return $n;
    }

    /**
     * @return Builder
     */
    public function numbersQuery(): Builder
    {
        return Post::where('category_id', $this->category_id)
                    ->where('module_id', $this->module_id);
    }
}
