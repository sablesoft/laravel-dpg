<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;
use App\Models\Traits\Cards;
use App\Models\Traits\Decks;
use App\Models\Traits\Sources;
use App\Models\Traits\Subscribers;

/**
 * @property-read Card[]|null $cards
 * @property-read Dome[]|null $domes
 * @property-read Book[]|null $usedInBooks
 * @property-read Dome[]|null $usedInDomes
 * @property-read Area[]|null $usedInAreas
 */
class Book extends Content
{
    use HasTranslations, Subscribers, Cards, Decks, Sources;

    const SUBSCRIBER_TYPE_PUBLIC = 0;
    const SUBSCRIBER_TYPE_LICENCE = 1;

    /**
     * @var array|string[]
     */
    public array $translatable = ['name', 'desc'];

    /**
     * @return BelongsToMany
     */
    public function domes(): BelongsToMany
    {
        return $this->belongsToMany(Dome::class);
    }

    /**
     * @return BelongsToMany
     */
    public function usedInBooks(): BelongsToMany
    {
        return $this->belongsToMany(
            Book::class,
            'source_relation',
            'source_id',
        );
    }

    /**
     * @return BelongsToMany
     */
    public function usedInDomes(): BelongsToMany
    {
        return $this->belongsToMany(
            Dome::class,
            'source_relation',
            'source_id',
        );
    }

    /**
     * @return BelongsToMany
     */
    public function usedInAreas(): BelongsToMany
    {
        return $this->belongsToMany(
            Area::class,
            'source_relation',
            'source_id',
        );
    }

    /**
     * @return BelongsToMany
     */
    public function subscribers(): BelongsToMany
    {
        return $this->_subscribers('book');
    }

    /**
     * @param User $user
     * @return bool
     */
    public function hasFullAccess(User $user): bool
    {
        /** @var Card $card */
        foreach ($this->cards as $card) {
            if (!$card->hasFullAccess($user)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return BelongsToMany
     */
    public function games(): BelongsToMany
    {
        return $this->belongsToMany(Game::class, 'game_book');
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
