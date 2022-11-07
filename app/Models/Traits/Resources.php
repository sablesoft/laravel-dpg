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
            $path = trim(config('nova.path'), '/');
            $href = url(sprintf("/$path/resources/%s/%d", $key, $content->getKey()));
            $name = $content->name;
            $links[] = "<a href='$href' class='no-underline dim text-primary font-bold'>$name</a>";
        }

        return $links ? implode(', ', $links) : null;
    }
}
