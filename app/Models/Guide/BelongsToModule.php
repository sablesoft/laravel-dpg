<?php

namespace App\Models\Guide;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int|null $module_id
 * @property Module|null $module
 */
trait BelongsToModule
{
    /**
     * @return BelongsTo
     */
    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }
}
