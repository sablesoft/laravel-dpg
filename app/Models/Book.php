<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Spatie\Translatable\HasTranslations;

/**
 * @property string|null $cards_back
 * @property-read Card[]|null $cards
 * @property-read Deck[]|null $decks
 * @property-read User[]|null $subscribers

 *
 * @property-read int|null $cards_count
 *
 * @method Builder allowedToSee() static
 */
class Book extends Content
{
    use HasTranslations;

    const SUBSCRIBER_TYPE_PUBLIC = 0;
    const SUBSCRIBER_TYPE_LICENCE = 1;

    /**
     * @var array|string[]
     */
    public array $translatable = ['name', 'desc'];

    /**
     * @return BelongsToMany
     */
    public function cards(): BelongsToMany
    {
        return $this->belongsToMany(Card::class, 'book_card');
    }

    /**
     * @return BelongsToMany
     */
    public function subscribers(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'book_subscriber',
            'book_id',
            'subscriber_id'
        )->withPivot(['type']);
    }

    /**
     * @return int|null
     */
    public function getCardsCountAttribute(): ?int
    {
        return $this->cards()->count() ?: null;
    }

    /**
     * @return HasMany
     */
    public function decks(): HasMany
    {
        return $this->hasMany(Deck::class);
    }

    /**
     * @return array
     */
    public function export(): array
    {
        $data = parent::export();
        $data['cards'] = $this->cards()->get()->pluck('name')->toArray();

        return $data;
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeAllowedToSee(Builder $query): Builder
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user->isAdmin()) {
            return $query;
        }

        $query->orWhere('is_public', true)
            ->whereHas('subscribers', function($query) use ($user) {
                $query->orWhere('subscriber_id', $user->getKey());
            });

        return $query;
    }

    /**
     * @return array
     */
    public static function subscriberTypeOptions(): array
    {
        return [
            self::SUBSCRIBER_TYPE_PUBLIC => __('Public'),
            self::SUBSCRIBER_TYPE_LICENCE => __('Licence'),
        ];
    }
}
