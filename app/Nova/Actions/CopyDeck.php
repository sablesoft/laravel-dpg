<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ActionFields;
use App\Models\Book;
use App\Models\Deck;
use App\Models\User;

class CopyDeck extends Action
{
    use InteractsWithQueue, Queueable;

    const FIELD_BOOK_ID = 'book_id';
    const FIELD_COPY_CARDS = 'copy_cards';

    /**
     * Get the displayable name of the action.
     *
     * @return string
     */
    public function name(): string
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
        /** @var User $user */
        $user = Auth::user();
        $bookId = (int) $fields->get(static::FIELD_BOOK_ID);
        $copyCards = (bool) $fields->get(static::FIELD_COPY_CARDS);
        /** @var Deck $model */
        foreach ($models as $model) {
            if (!$model->hasFullAccess($user)) {
                return Action::danger(
                    __("You cannot copy one of deck. You don't have full access to all its cards.")
                );
            }
        }
        foreach ($models as $model) {
            if (!$model->makeCopy($user, $error, $bookId, $copyCards)) {
                return Action::danger($error);
            }
        }

        return Action::message(__('Decks Copied'));
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

        return [
            Select::make(__('Into Book'), self::FIELD_BOOK_ID)
                ->required(true)->nullable(false)
                ->options($options)->rules('required')
                ->displayUsingLabels(),
            Boolean::make(__('Copy Cards'), self::FIELD_COPY_CARDS)
                ->nullable(false)->default(function() {return false;})
        ];
    }
}
