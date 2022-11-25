<?php

namespace App\Nova\Actions;

use App\Models\Book;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use App\Models\Card;
use Laravel\Nova\Fields\Select;

class CopyCard extends Action
{
    const FIELD_BOOK_ID = 'book_id';

    /**
     * Perform the action on the given models.
     *
     * @param ActionFields $fields
     * @param Collection $models
     * @return array
     */
    public function handle(ActionFields $fields, Collection $models): array
    {
        /** @var Card $model */
        foreach ($models as $model) {

        }

        return Action::message('Cards Copied');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(): array
    {
        $user = Auth::user();

        return [
            Select::make(__('Book'), 'book_id')
                ->options(Book::select()->where())
        ];
    }
}
