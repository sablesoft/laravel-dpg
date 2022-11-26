<?php

namespace App\Nova\Actions;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use App\Models\Card;
use App\Models\Book;

class CopyCard extends Action
{
    const FIELD_BOOK_ID = 'book_id';

    /**
     * Get the displayable name of the action.
     *
     * @return string
     */
    public function name()
    {
        return __('Make Copy');
    }

    /**
     * Perform the action on the given models.
     *
     * @param ActionFields $fields
     * @param Collection $models
     * @return array
     */
    public function handle(ActionFields $fields, Collection $models): array
    {
        $bookId = $fields->get(static::FIELD_BOOK_ID);

        /** @var Card $model */
        foreach ($models as $model) {
            $newCard = $model->replicate();
            $newCard->created_at = Carbon::now();
            $newCard->is_public = false;
            $newCard->owner_id = Auth::user()->getKey();
            $newCard->name = $newCard->name . ' - COPY';
            $newCard->save();
            if ($bookId) {
                $newCard->books()->attach($bookId);
            }
        }

        return Action::message(__('Cards Copied'));
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(): array
    {
        /** @var Collection $options */
        $options = Book::query()->isPublic()->isOwner(Auth::user(), 'or')
            ->pluck('name', 'id')->toArray();

        return $options ? [
            Select::make(__('Into Book'), self::FIELD_BOOK_ID)
                ->required(false)->nullable(true)
                ->options($options)
                ->displayUsingLabels()
        ] : [];
    }
}
