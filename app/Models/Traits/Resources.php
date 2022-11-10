<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;
use App\Models\Content;

trait Resources
{
    /**
     * @param string $key
     * @return string|null
     */
    protected function getResourcesString(string $key, string $resource = null): ?string
    {
        $links = [];
        $resource = $resource ?: $key;
        /** @var Content $content */
        foreach ($this->getFilteredResources($key) as $content) {
            $path = trim(config('nova.path'), '/');
            $href = url(sprintf("/$path/resources/%s/%d", $resource, $content->getKey()));
            $name = $content->name;
            $links[] = "<a href='$href' class='no-underline dim text-primary font-bold'>$name</a>";
        }

        return $links ? implode(', ', $links) : null;
    }

    /**
     * @param string $key
     * @return Collection
     */
    protected function getFilteredResources(string $key): Collection
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user->isAdmin()) {
            return $this->$key;
        }

        return $this->$key()->where('is_public', '=', true)
                    ->orWhere('owner_id', '=', $user->getKey())->get();
    }
}
