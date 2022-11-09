<?php

namespace App\Models\Traits;

/**
 * @property-read string|null $books_string
 */
trait Books
{
    use Resources;

    /**
     * @return string|null
     */
    public function getBooksStringAttribute(): ?string
    {
        return $this->getResourcesString('books');
    }
}
