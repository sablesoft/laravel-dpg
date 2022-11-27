<?php

namespace App\Nova\Actions;

use App\Service\ImageService;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use App\Models\Card;
use App\Models\User;
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
        /** @var User $user */
        $user = Auth::user();
        $bookId = $fields->get(static::FIELD_BOOK_ID);

        /** @var Card $model */
        foreach ($models as $model) {
            if (!$model->hasAccessToScopes($user)) {
                return Action::danger(
                    __("You cannot copy this card. You don't have access to one of its scopes.")
                );
            }
            if (!$filename = ImageService::copyImage($model->image)) {
                return Action::danger(
                    __("Image copy error!")
                );
            }
            $newCard = $model->replicate();
            $newCard->image = $filename;
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
