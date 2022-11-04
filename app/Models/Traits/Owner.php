<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

/**
 * @property int|null $owner_id
 *
 * @property-read User|null $owner
 */
trait Owner
{
    /**
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
