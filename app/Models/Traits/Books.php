<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
        /** @var User $user */
        $user = Auth::user();
        if (!$user->isAdmin()) {
            $this->relationshipFilter = function ($query) use ($user) {
                return
                    $query->orWhereHas('subscribers', function ($query) use ($user) {
                        return $query->where('subscriber_id', $user->getKey());
                    });
            };
        }

        $string = $this->getResourcesString('books');
        $this->relationshipFilter = null;

        return $string;
    }
}
