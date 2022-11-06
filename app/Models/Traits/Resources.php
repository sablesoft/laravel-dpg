<?php

namespace App\Models\Traits;

use App\Models\Content;
use Illuminate\Database\Eloquent\Collection;

trait Resources
{
    /**
     * @param string $key
     * @return string|null
     */
    protected function getResourcesString(string $key): ?string
    {
        /** @var Collection $resources */
        $resources = $this->$key;
        $names = $resources->map(function(Content $content) {
           return [$content->getKey() => $content->name];
        })->collapse()->toArray();

        $links = [];
        foreach ($names as $id => $name) {
            $href = url(sprintf("/nova/resources/%s/%d", $key, $id));
            $links[] = "<a href='$href'>$name</a>";
        }

        return $links ? implode(', ', $links) : null;
    }
}
