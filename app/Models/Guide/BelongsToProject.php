<?php

namespace App\Models\Guide;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property Project|null $project
 */
trait BelongsToProject
{
    /**
     * @return BelongsTo
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
