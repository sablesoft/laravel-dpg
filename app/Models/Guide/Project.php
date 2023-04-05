<?php

namespace App\Models\Guide;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int|null $id
 * @property string|null $name
 * @property string|null $code
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Topic[]|Collection $topics
 */
class Project extends GuideItem
{
    use HasNotes, HasPosts;

    protected $table = 'projects';

    protected $fillable = [
        'name',
        'code',
        'owner_id'
    ];

    /**
     * @return HasMany
     */
    public function topics(): HasMany
    {
        return $this->hasMany(Topic::class);
    }
}
