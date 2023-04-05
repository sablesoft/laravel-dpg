<?php

namespace App\Models\Guide;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property Topic|null $topic
 */
trait BelongsToTopic
{
    /**
     * @return BelongsTo
     */
    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }
}
