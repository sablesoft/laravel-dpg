<?php

namespace App\Models\Process;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Relations\HasMany;
use App\Models\Game;

/**
 * @property int|null $id
 * @property string|null $name
 * @property string|null $desc
 * @property string|null $image
 * @property string|null $board_image
 * @property string|null $cards_back
 * @property string|null $scope_name
 * @property int|null $quest_id
 * @property int[]|null $hero_ids
 * @property int[]|null $open_card_ids
 * @property int[]|null $open_deck_ids
 * @property int[]|null $open_dome_ids
 * @property int[]|null $open_area_ids
 * @property int[]|null $open_lands_ids
 * @property int[]|null $open_scene_ids
 * @property array[]|null $canvas
 * @property-read Game|null $game
 * @property-read CardProcess[]|Collection|null $cards
 * @property-read BookProcess[]|Collection|null $books
 * @property-read BookProcess[]|Collection|null $decks
 * @property-read DomeProcess[]|Collection|null $domes
 * @property-read AreaProcess[]|Collection|null $areas
 * @property-read LandProcess[]|Collection|null $lands
 * @property-read SceneProcess[]|Collection|null $scenes
 */
class GameProcess extends Model
{
    protected $collection = 'games';
    protected $connection = 'mongodb';

    protected $fillable = [
        'id',
        'name',
        'desc',
        'image',
        'board_image',
        'cards_back',
        'scope_name',
        'quest_id',
        'hero_ids',
    ];

    protected $hidden = [
        '_id',
        'created_at',
        'updated_at'
    ];

    /**
     * @return HasOne
     */
    public function game(): HasOne
    {
        return $this->hasOne(Game::class, 'process_id');
    }

    /**
     * @return HasMany
     */
    public function books(): HasMany
    {
        return $this->hasMany(BookProcess::class);
    }

    public function cards(): HasMany
    {
        return $this->hasMany(CardProcess::class);
    }

    /**
     * @return HasMany
     */
    public function decks(): HasMany
    {
        return $this->hasMany(DeckProcess::class);
    }

    /**
     * @return HasMany
     */
    public function domes(): HasMany
    {
        return $this->hasMany(DomeProcess::class);
    }

    /**
     * @return HasMany
     */
    public function areas(): HasMany
    {
        return $this->hasMany(AreaProcess::class);
    }

    /**
     * @return HasMany
     */
    public function lands(): HasMany
    {
        return $this->hasMany(LandProcess::class);
    }

    /**
     * @return HasMany
     */
    public function scenes(): HasMany
    {
        return $this->hasMany(SceneProcess::class);
    }

    public function toArray(): array
    {
        $this->setRelation('books', $this->books->keyBy('id'));
        $this->setRelation('cards', $this->cards->keyBy('id'));
        $this->setRelation('decks', $this->decks->keyBy('id'));
        $this->setRelation('domes', $this->domes->keyBy('id'));
        $this->setRelation('areas', $this->areas->keyBy('id'));
        $this->setRelation('lands', $this->lands->keyBy('id'));
        $this->setRelation('scenes', $this->scenes->keyBy('id'));
        return parent::toArray();
    }
}
