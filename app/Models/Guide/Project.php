<?php

namespace App\Models\Guide;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int|null $id
 * @property string|null $name
 * @property string|null $code
 * @property string|null $text
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Buffer|null $buffer
 */
class Project extends GuideItem
{
    use HasNotes, HasPosts, HasTopics, HasTags;

    protected $table = 'guide_projects';

    protected $fillable = [
        'name',
        'code',
        'text',
        'owner_id'
    ];

    /**
     * @return HasOne
     */
    public function buffer(): HasOne
    {
        return $this->hasOne(Buffer::class);
    }
}
