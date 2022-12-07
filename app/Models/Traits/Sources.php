<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Book;

/**
 * @property-read Book[]|null $sources
 */
trait Sources
{
    /**
     * @return BelongsToMany
     */
    public function sources(): BelongsToMany
    {
        $name = explode('\\', static::class);
        $name = end($name);
        $key = strtolower($name) . '_id';
        return $this->belongsToMany(
            Book::class,
            'source_relation',
            $key,
            'source_id',
        );
    }
}
