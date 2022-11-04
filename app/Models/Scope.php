<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Traits\Tags;
use App\Models\Traits\Owner;

/**
 * @property int|null $id
 * @property string|null $name
 * @property string|null $desc
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Tag[]|null $tags
 * @property-read Card[]|null $cards
 */
class Scope extends Model
{
    use HasFactory, Tags, Owner;

    /**
     * @return HasMany
     */
    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class);
    }

    /**
     * @return HasMany
     */
    public function cards(): HasMany
    {
        return $this->hasMany(Card::class);
    }
}
