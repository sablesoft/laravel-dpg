<?php

namespace App\Models\Traits;

trait Resources
{
    /**
     * @param string $key
     * @return string|null
     */
    protected function getResourcesString(string $key): ?string
    {
        $resources = $this->$key()->get(['id', 'name'])->toArray();

        $links = [];
        foreach ($resources as $resource) {
            $name = $resource['name'];
            $href = url(sprintf("/nova/resources/%s/%d", $key, $resource['id']));
            $links[] = "<a href='$href'>$name</a>";
        }

        return $links ? implode(', ', $links) : null;
    }
}
