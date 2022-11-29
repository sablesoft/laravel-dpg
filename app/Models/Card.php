<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Traits\Tags;
use App\Models\Traits\Decks;
use App\Models\Traits\Books;
use App\Service\ImageService;

/**
 * @property-read Card[]|null $tags
 * @property-read Decks[]|null $decks
 * @property-read Decks[]|null $inDecks
 * @property-read Books[]|null $books
 * @property-read Card[]|null $scopedCards
 * @property-read Deck[]|null $scopedDecks
 * @property-read Card[]|null $taggedCards
 *
 * @property-read object|null pivot
 */
class Card extends Content
{
    use Tags, Decks, Books;

    /**
     * @var array|string[]
     */
    public array $translatable = ['name', 'desc'];

    /**
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(
            Card::class,
            'card_tag',
            'card_id',
            'tag_id'
        );
    }

    /**
     * @param User $user
     * @return bool
     */
    public function hasFullAccess(User $user): bool
    {
        return $this->hasAccess($user) && $this->hasAccessToScopes($user);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function hasAccess(User $user): bool
    {
        if ($user->isAdmin() || $this->isOwner($user) || $this->is_public) {
            return true;
        }
        return $this->books()->whereHas('subscribers', function(Builder $query) use ($user) {
            $query->where('subscriber_id', $user->getKey());
        })->exists();
    }

    /**
     * @param User $user
     * @param Card|null $card
     * @return bool
     */
    public function hasAccessToScopes(User $user, ?Card $card = null): bool
    {
        $card = $card ?: $this;
        if (!$scope = $card->scope) {
            return true;
        }
        if (!$scope->hasAccess($user)) {
            return false;
        }

        return $this->hasAccessToScopes($user, $scope);
    }

    /**
     * @return HasMany
     */
    public function scopedCards(): HasMany
    {
        return $this->hasMany(Card::class, 'scope_id');
    }

    /**
     * @return BelongsToMany
     */
    public function taggedCards(): BelongsToMany
    {
        return $this->belongsToMany(
            Card::class,
            'card_tag',
            'tag_id',
            'card_id'
        );
    }

    /**
     * @return BelongsToMany
     */
    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'book_card');
    }

    /**
     * @return BelongsToMany
     */
    public function inDecks(): BelongsToMany
    {
        return $this->belongsToMany(
            Deck::class,
            'deck_card',
        )->withPivot('count');
    }

    /**
     * @return HasMany
     */
    public function decks(): HasMany
    {
        return $this->hasMany(Deck::class);
    }

    /**
     * @return HasMany
     */
    public function scopedDecks(): HasMany
    {
        return $this->hasMany(Deck::class, 'scope_id');
    }

    /**
     * @return array
     */
    public function export(): array
    {
        $data = parent::export();
        $data['scope'] = optional($this->scope)->name;
        $data['decks'] = $this->decks()->get()->pluck('name')->toArray();
        $data['in_decks'] = $this->inDecks()->get()->pluck('name')->toArray();

        return $data;
    }

    /**
     * @param User $user
     * @param null|string $error
     * @param int|null $bookId
     * @return Card|null
     */
    public function makeCopy(User $user, ?string &$error, ?int $bookId = null): ?Card
    {
        $filename = null;
        if ($this->image && (!$filename = ImageService::copyImage($this->image))) {
            $error = __("Image copy error!");
            return null;
        }
        $card = $this->replicate();
        $card->image = $filename;
        $card->created_at = Carbon::now();
        $card->is_public = false;
        $card->owner_id = $user->getKey();
        $card->name = $card->name . ' - COPY';
        if (!$card->save()) {
            $error = __('Save error');
            return null;
        }
        if ($bookId) {
            $card->books()->attach($bookId);
        }

        return $card;
    }

    /**
     * @param Card $scope
     * @param Card $card
     * @return bool
     */
    public static function validateScope(Card $scope, Card $card): bool
    {
        if (!$card->scope) {
            return false;
        }

        if ($card->scope->getKey() !== $scope->getKey()) {
            return static::validateScope($scope, $card->scope);
        } else {
            return true;
        }
    }
}
