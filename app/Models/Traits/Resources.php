<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;
use App\Models\Content;

trait Resources
{
    protected ?\Closure $relationshipFilter = null;

    /**
     * @param string $key
     * @param string|null $resource
     * @return string|null
     */
    protected function getResourcesString(string $key, string $resource = null): ?string
    {
        $links = [];
        $resource = $resource ?: $key;
        /** @var Content $content */
        $path = trim(config('nova.path'), '/');
        foreach ($this->getFilteredResources($key) as $content) {
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

        $query = $this->$key()->select(['id', 'name']);
        if ($this->relationshipFilter instanceof \Closure) {
            $closure = $this->relationshipFilter;
            /** @var Builder $query */
            $query->where(function(Builder $query) use ($closure, $user) {
                $query = $closure($query);
                $query->orWhere('is_public', '=', true)
                    ->orWhere('owner_id', '=', $user->getKey());
                return $query;
            });
        } else {
            $query->where('is_public', '=', true)
                ->orWhere('owner_id', '=', $user->getKey());
        }
        return $query->distinct('id')->get();
    }
}
