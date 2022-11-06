<?php

namespace App\Models\Traits;

use App\Models\Content;

trait Resources
{
    /**
     * @param string $key
     * @return string|null
     */
    protected function getResourcesString(string $key): ?string
    {
        $links = [];
        /** @var Content $content */
        foreach ($this->$key as $content) {
            $href = url(sprintf("/nova/resources/%s/%d", $key, $content->getKey()));
            $name = $content->name;
            $links[] = "<a href='$href'>$name</a>";
        }

        return $links ? implode(', ', $links) : null;
    }
}
