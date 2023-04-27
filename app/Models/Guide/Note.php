<?php

namespace App\Models\Guide;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int|null $id
 * @property int|null $post_id
 * @property string|null $text
 * @property int|null $number
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Link[]|Collection $targetLinks
 *
 * @property-read string|null $title
 */
class Note extends GuideItem implements UseNumber
{
    use BelongsToProject, BelongsToModule, BelongsToTopic, BelongsToPost, HasLinks;

    protected $table = 'guide_notes';

    protected $fillable = [
        'topic_id',
        'project_id',
        'module_id',
        'post_id',
        'text',
        'number'
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

    /**
     * @param int|null $postId
     * @param int|null $projectId
     * @param int|null $moduleId
     * @return int|null
     */
    public static function allowedNumber(?int $postId = null, ?int $projectId = null, ?int $moduleId = null): ?int
    {
        $valid = ($postId && (!$projectId && !$moduleId)) ||
                 ($projectId && (!$postId && !$moduleId)) ||
                 ($moduleId && (!$projectId && !$postId));
        if (!$valid) {
            return null;
        }

        $n = 1;
        $numbers = static::where('post_id', $postId)
            ->where('project_id', $projectId)
            ->where('module_id', $moduleId)->pluck('number')->toArray();
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
        return Note::where('post_id', $this->post_id)
            ->where('project_id', $this->project_id)
            ->where('module_id', $this->module_id);
    }
}
