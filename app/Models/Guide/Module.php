<?php

namespace App\Models\Guide;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int|null $id
 * @property int|null $number
 * @property int|null $type_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Topic|null $type
 */
class Module extends GuideItem implements UseNumber
{
    use BelongsToProject, BelongsToTopic, HasNotes, HasPosts, HasTopics;

    protected $table = 'guide_modules';

    protected $fillable = [
        'project_id',
        'type_id',
        'topic_id',
        'owner_id',
        'number',
    ];

    /**
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(Topic::class, 'type_id');
    }


    /**
     * @param int $projectId
     * @param int $typeId
     * @return int|null
     */
    public static function allowedNumber(int $projectId, int $typeId): ?int
    {
        $n = 1;
        $numbers = static::where('project_id', $projectId)->where('type_id', $typeId)
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
        return Module::where('project_id', $this->project_id);
    }
}
