<?php

namespace App\Nova\Filters;

use OptimistDigtal\NovaMultiselectFilter\MultiselectFilter;

abstract class ContentFilter extends MultiselectFilter
{
    /**
     * Get the displayable name of the filter.
     *
     * @return string
     */
    public function name(): string
    {
        return __(parent::name());
    }
}
