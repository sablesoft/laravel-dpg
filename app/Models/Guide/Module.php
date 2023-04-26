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
     * @return Builder
     */
    public function numbersQuery(): Builder
    {
        return Module::where('project_id', $this->project_id);
    }
}
