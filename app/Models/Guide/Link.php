<?php

namespace App\Models\Guide;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int|null $id
 * @property int|null $number
 * @property int|null $post_id
 * @property int|null $note_id
 * @property int|null $target_category_id
 * @property int|null $target_post_id
 * @property int|null $target_note_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Note|null $note
 * @property Topic|null $targetCategory
 * @property Post|null $targetPost
 * @property Note|null $targetNote
 */
class Link extends GuideItem
{
    use BelongsToPost;

    protected $table = 'guide_links';

    protected $fillable = [
        'target_category_id',
        'target_post_id',
        'target_note_id',
        'post_id',
        'note_id',
        'number',
    ];

    /**
     * @return BelongsTo
     */
    public function note(): BelongsTo
    {
        return $this->belongsTo(Note::class);
    }

    /**
     * @return BelongsTo
     */
    public function targetCategory(): BelongsTo
    {
        return $this->belongsTo(Topic::class, 'target_category_id');
    }

    /**
     * @return BelongsTo
     */
    public function targetPost(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'target_post_id');
    }

    /**
     * @return BelongsTo
     */
    public function targetNote(): BelongsTo
    {
        return $this->belongsTo(Note::class, 'target_note_id');
    }

    /**
     * @param int|null $postId
     * @param int|null $noteId
     * @return int|null
     */
    public static function allowedNumber(?int $postId = null, ?int $noteId = null): ?int
    {
        if (!($postId xor $noteId)) {
            return null;
        }

        $n = 1;
        $numbers = static::where('post_id', $postId)
            ->where('note_id', $noteId)->pluck('number')->toArray();
        sort($numbers);
        foreach ($numbers as $number) {
            if ($number > $n) {
                return $n;
            }
            $n++;
        }

        return $n;
    }
}
