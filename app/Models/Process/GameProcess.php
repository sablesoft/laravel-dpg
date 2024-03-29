<?php

namespace App\Models\Process;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Relations\HasMany;
use App\Models\Game;

/**
 * @property int|null $id
 * @property string|null $boardImage
 * @property string|null $cardsBack
 * @property int|null $questId
 * @property string|null $turn
 * @property array|null $played_ids
 * @property int[]|null $heroIds
 * @property int[]|null $cardIds
 * @property int[]|null $deckIds
 * @property int[]|null $visibleCardIds
 * @property int[]|null $visibleDeckIds
 * @property int[]|null $visibleDomeIds
 * @property int[]|null $visibleAreaIds
 * @property int[]|null $openLandsIds
 * @property int[]|null $openSceneSds
 * @property int|null $activeDomeId
 * @property int|null $activeAreaId
 * @property int|null $activeSceneId
 * @property array[]|null $canvas
 * @property-read Game|null $game
 * @property-read CardProcess[]|Collection|null $cards
 * @property-read BookProcess[]|Collection|null $books
 * @property-read BookProcess[]|Collection|null $decks
 * @property-read DomeProcess[]|Collection|null $domes
 * @property-read AreaProcess[]|Collection|null $areas
 * @property-read LandProcess[]|Collection|null $lands
 * @property-read SceneProcess[]|Collection|null $scenes
 * @property-read JournalProcess[]|Collection|null $journal
 */
class GameProcess extends Model
{
    protected $collection = 'games';
    protected $connection = 'mongodb';

    protected $fillable = [
        'id',
        'info',
        'turn',
        'boardImage',
        'cardsBack',
        'questId',
        'heroIds',
        'cardIds',
        'deckIds',
        'visibleCardIds',
        'visibleDeckIds',
        'visibleDomeIds',
        'visibleLandIds',
        'visibleAreaIds',
        'visibleSceneIds',
        'canvas',
        'activeDomeId',
        'activeAreaId',
        'activeSceneId',
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
     * @return Game
     */
    public function getGame(): Game
    {
        return Game::where('process_id', $this->getKey())->first();
    }

    /**
     * @return HasMany
     */
    public function journal(): HasMany
    {
        return $this->hasMany(JournalProcess::class);
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
        $this->setRelation('journal', $this->journal);
        return parent::toArray();
    }
}
