<?php

namespace App\Nova\Actions;

use App\Service\CopyService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ActionFields;
use App\Models\Book;
use App\Models\User;

class CopyBook extends Action
{
    const FIELD_BOOK_ID = 'book_id';
    const FIELD_COPY_CARDS = 'copy_cards';
    const FIELD_COPY_DECKS = 'copy_decks';

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
        $copyDecks = (bool) $fields->get(static::FIELD_COPY_DECKS);
        /** @var Book $model */
        foreach ($models as $model) {
            if (!$model->hasFullAccess($user)) {
                return Action::danger(
                    __("You cannot copy one of books. You don't have full access to all its cards.")
                );
            }
        }
        $config = [
            CopyService::CONFIG_USER => $user,
            CopyService::CONFIG_BOOK_ID => $bookId,
            CopyService::CONFIG_COPY_CARDS => $copyCards,
            CopyService::CONFIG_COPY_DECKS => $copyDecks
        ];
        $processedCards = [];
        foreach ($models as $model) {
            CopyService::copyBook($model, $processedCards, $config);
        }

        return Action::message(__('Books Copied'));
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(): array
    {
        /** @var Collection $options */
        $options = Book::query()->isOwner(Auth::user())
            ->pluck('name', 'id')->toArray();

        return [
            Select::make(__('Into Book'), self::FIELD_BOOK_ID)
                ->nullable(true)->options($options)->displayUsingLabels(),
            Boolean::make(__('Copy Cards'), self::FIELD_COPY_CARDS)
                ->nullable(false)->default(function() {return false;}),
            Boolean::make(__('Copy Decks'), self::FIELD_COPY_DECKS)
                ->nullable(false)->default(function() {return false;}),
        ];
    }
}
