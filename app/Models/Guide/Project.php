<?php

namespace App\Models\Guide;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Owner;

/**
 * @property int|null $id
 * @property string|null $name
 * @property string|null $code
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Note[]|Collection $notes
 * @property-read Post[]|Collection $posts
 * @property-read Topic[]|Collection $topics
 */
class Project extends Model
{
    use Owner;

    protected $table = 'guide_projects';

    protected $fillable = [
        'name',
        'code',
        'owner_id'
    ];

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
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    /**
     * @return HasMany
     */
    public function topics(): HasMany
    {
        return $this->hasMany(Topic::class);
    }

    /**
     * @return void
     */
    public static function boot(): void
    {
        parent::boot();

        static::creating(function (Project $project) {
            $project->owner()->associate(Auth::user());
        });
    }
}
