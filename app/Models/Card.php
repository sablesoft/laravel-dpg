<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Traits\Tags;
use App\Models\Traits\Decks;
use App\Models\Traits\Books;

/**
 * @property-read Card[]|null $tags
 * @property-read Decks[]|null $inDecks
 * @property-read Books[]|null $books
 * @property-read Dome[]|null $domes
 * @property-read Area[]|null $areas
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
        if ($user->isAdmin() || $this->isOwnedBy($user) || $this->is_public) {
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
    public function domes(): BelongsToMany
    {
        return $this->belongsToMany(Dome::class, 'dome_card');
    }

    /**
     * @return BelongsToMany
     */
    public function areas(): BelongsToMany
    {
        return $this->belongsToMany(Area::class);
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

    /**
     * @param string $code
     * @return Card|null
     */
    public static function getCardByCode(string $code): ?Card
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return static::query()->where('code', $code)->first();
    }
}
