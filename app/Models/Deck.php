<?php

namespace App\Models;

use App\Service\ImageService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

/**
 * @property int|null $type
 * @property int|null $card_id
 * @property int|null $book_id
 *
 * @property-read string|null $name
 * @property-read Book|null $book
 * @property-read Card|null $target
 * @property-read Card[]|null $tags
 * @property-read Card[]|null $cards
 *
 * @property-read int[]|null $size
 */
class Deck extends Content
{
    const TYPE_STACK = 0;
    const TYPE_SET = 1;
    const TYPE_UNIQUE = 2;
    const TYPE_CONTROL = 3;

    /**
     * @return string|null
     */
    public function getNameAttribute(): ?string
    {
        $target = optional($this->target)->name;
        $scope = optional($this->scope)->name;

        return ($target && $scope) ?
            $target .' - '. $scope : null;
    }

    /**
     * @param $value
     * @return void
     */
    public function setNameAttribute($value)
    {
    }

    /**
     * @return BelongsTo
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * @return BelongsTo
     */
    public function target(): BelongsTo
    {
        return $this->belongsTo(Card::class, 'card_id');
    }

    /**
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(
            Card::class,
            'deck_tag',
            'deck_id',
            'tag_id'
        );
    }

    /**
     * @return BelongsToMany
     */
    public function cards(): BelongsToMany
    {
        return $this->belongsToMany(Card::class, 'deck_card')
            ->withPivot('count');
    }

    /**
     * @return int|null
     */
    public function getSizeAttribute(): ?int
    {
        return $this->cards()->sum('count') ?: null;
    }

    /**
     * @param User $user
     * @param string $error
     * @param int $bookId
     * @param bool $copyCards
     * @return null|Deck
     */
    public function makeCopy(User $user, ?string &$error, int $bookId, bool $copyCards = false): ?Deck
    {
        $exists = Deck::query()->where('book_id', $bookId)
            ->where('card_id', $this->card_id)
            ->where('scope_id', $this->scope_id)->exists();
        if ($exists) {
            $error = __('This deck already exists in this book');
            return null;
        }
        $deck = $this->replicate();
        $deck->book_id = $bookId;
        $deck->owner_id = $user->getKey();
        $deck->created_at = Carbon::now();
        $deck->is_public = false;
        if ($this->image) {
            if (!$filename = ImageService::copyImage($this->image)) {
                $error = __("Image copy error!");
                return null;
            }
            $this->image = $filename;
        }
        if ($copyCards) {
            if (!$target = $this->target->makeCopy($user, $cardError, $bookId)) {
                $error = __('Card copy error: ') . $cardError;
                return null;
            }
            if (!$scope = $this->scope->makeCopy($user, $cardError, $bookId)) {
                $error = __('Card copy error: ') . $cardError;
                return null;
            }
            $deck->card_id = $target->getKey();
            $deck->scope_id = $scope->getKey();
        }
        $deck->save();
        foreach ($this->cards as $card) {
            if ($copyCards) {
                $card = $card->makeCopy($user, $cardError, $bookId);
                if (!$card) {
                    $error = __('Card copy error: ') . $cardError;
                    return null;
                }
            }
            $deck->cards()->attach($card);
        }

        return $deck;
    }

    /**
     * @param User $user
     * @return bool
     * @noinspection PhpParamsInspection
     */
    public function hasFullAccess(User $user): bool
    {
        return $this->checkCardsAccess($user, collect([$this->target, $this->scope])) &&
            $this->checkCardsAccess($user, $this->cards);
    }

    /**
     * @param User $user
     * @param Collection $cards
     * @return bool
     */
    protected function checkCardsAccess(User $user, Collection $cards): bool
    {
        /** @var Card $card */
        foreach ($cards as $card) {
            if (!$card->hasFullAccess($user)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return array
     */
    public function export(): array
    {
        $data = parent::export();
        $data['scope'] = optional($this->scope)->name;
        $data['book'] = optional($this->book)->name;
        $data['target'] = optional($this->target)->name;
        $data['type'] = $this->type;
        $data['cards'] = $this->cards()->get()->pluck('name')->toArray();

        return $data;
    }

    /**
     * @return array
     */
    public static function getTypeOptions(): array
    {
        return [
            self::TYPE_STACK => __('Stack'),
            self::TYPE_SET => __('Set'),
            self::TYPE_UNIQUE => __('Unique'),
            self::TYPE_CONTROL => __('Control')
        ];
    }
}
