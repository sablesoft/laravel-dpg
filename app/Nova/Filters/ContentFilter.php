<?php

namespace App\Nova\Filters;

use Illuminate\Database\Eloquent\Builder;
use OptimistDigtal\NovaMultiselectFilter\MultiselectFilter;

abstract class ContentFilter extends MultiselectFilter
{
    /**
     * @var bool
     */
    protected bool $useWhereHas = true;

    /**
     * @var string|null
     */
    protected ?string $whereInField;

    /**
     * @param bool $useWhereHas
     * @param string|null $whereInField
     */
    public function __construct(bool $useWhereHas = true, ?string $whereInField = null)
    {
        $this->useWhereHas = $useWhereHas;
        $this->whereInField = $whereInField;
    }

    /**
     * Get the displayable name of the filter.
     *
     * @return string
     */
    public function name(): string
    {
        return __(parent::name());
    }

    protected function applyWhereHasAndWhereIn(Builder $query, $value, string $relation): Builder
    {
        if ($this->useWhereHas) {
            return $query->whereHas($relation, function ($query) use ($value) {
                $query->whereIn($this->whereInField, $value);
            });
        } else {
            return $query->whereIn($this->whereInField, $value);
        }
    }
}
