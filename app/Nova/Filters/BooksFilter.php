<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use OptimistDigtal\NovaMultiselectFilter\MultiselectFilter;
use App\Models\Book;

class BooksFilter extends MultiselectFilter
{
    /**
     * The displayable name of the filter.
     *
     * @var string
     */
    public $name = 'Books';

    /**
     * Apply the filter to the given query.
     *
     * @param Request $request
     * @param  Builder  $query
     * @param  mixed  $value
     * @return Builder
     */
    public function apply(Request $request, $query, $value): Builder
    {
        return $query->whereHas('books', function ($query) use ($value) {
            $query->whereIn('book_id', $value);
        });
    }

    /**
     * Get the filter's available options.
     *
     * @param Request $request
     * @return array
     */
    public function options(Request $request): array
    {
        return Book::options();
    }
}
