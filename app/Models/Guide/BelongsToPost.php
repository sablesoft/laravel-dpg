<?php

namespace App\Models\Guide;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property Post|null $post
 */
trait BelongsToPost
{
    /**
     * @return BelongsTo
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
