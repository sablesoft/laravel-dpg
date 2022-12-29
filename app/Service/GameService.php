<?php /** @noinspection PhpPossiblePolymorphicInvocationInspection */

/** @noinspection PhpUndefinedMethodInspection */

namespace App\Service;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Area;
use App\Models\Book;
use App\Models\Card;
use App\Models\Deck;
use App\Models\Dome;
use App\Models\Game;
use App\Models\Land;
use App\Models\Scene;
use App\Models\SpaceInterface;
use App\Models\Process\Process;
use App\Models\Process\SceneProcess;
use App\Models\Process\AreaProcess;
use App\Models\Process\BookProcess;
use App\Models\Process\CardProcess;
use App\Models\Process\DeckProcess;
use App\Models\Process\DomeProcess;
use App\Models\Process\GameProcess;
use App\Models\Process\LandProcess;
use App\Models\Process\SpaceProcessInterface;

class GameService
{
    /**
     * @param Game $game
     * @return void
     */
    public static function dropProcess(Game $game): void
    {
        /** @var GameProcess|null $process */
        if (!$process = GameProcess::where('id', $game->getKey())->first()) {
            return;
        }

        foreach(Process::collections() as $collection) {
            DB::connection('mongodb')->collection($collection)
                ->where(Process::GAME_FOREIGN_KEY, $process->getKey())
                ->delete();
        }

        $process->delete();
    }

    /**
     * @param Game $game
     * @return GameProcess
     * @throws Exception
     */
    public static function initProcess(Game $game): GameProcess
    {
        static::dropProcess($game);

        $game->makeHidden([
            'id',
            'process_id', 'board_image', 'cards_back',
            'owner_id', 'quest_id', 'created_at',
            'is_public', 'status', 'updated_at'
        ]);
        $info = self::toArray($game, $game->translatable);
        $info['image'] = self::image($info['image']);
        $info['type'] = 'game';
        $data = [
            'id' => $game->getKey(),
            'info' => $info,
            'boardImage' => self::image($game->board_image),
            'cardsBack' => self::image($game->cards_back),
        ];

        /** @var GameProcess $gameProcess */
        $gameProcess = GameProcess::create($data);
        $gameProcess->questId = static::cardToProcess($gameProcess, $game->quest)->id;
        $cardIds = [];
        foreach ($game->heroes as $hero) {
            $cardIds[] = static::cardToProcess($gameProcess, $hero)->id;
        }
        $gameProcess->heroIds = $cardIds;
        // prepare all sources:
        /** @var Book[] $books */
        $books = [];
        foreach ($game->books as $book) {
            static::prepareBooks($books, $book);
            foreach ($book->domes as $dome) {
                foreach ($dome->sources as $source) {
                    static::prepareBooks($books, $source);
                }
                foreach ($dome->areas as $area) {
                    foreach ($area->sources as $source) {
                        static::prepareBooks($books, $source);
                    }
                }
                foreach ($dome->lands as $land) {
                    foreach ($land->sources as $source) {
                        static::prepareBooks($books, $source);
                    }
                }
            }
            foreach ($book->scenes as $scene) {
                foreach ($scene->sources as $source) {
                    static::prepareBooks($books, $source);
                }
            }
        }
        // prepare books and all cards:
        foreach ($books as $book) {
            $gameProcess->books()->save(static::bookToProcess($gameProcess, $book));
        }
        // prepare decks, domes and areas:
        foreach ($books as $book) {
            foreach ($book->domes as $dome) {
                static::domeToProcess($gameProcess, $dome);
            }
            foreach ($book->decks as $deck) {
                static::deckToProcess($gameProcess, $deck);
            }
        }
        $cardIds = [];
        foreach ($game->cards as $card) {
            $cardIds[] = static::cardToProcess($gameProcess, $card)->id;
        }
        $gameProcess->cardIds = $cardIds;
        $cardIds = [];
        foreach ($game->decks as $deck) {
            $cardIds[] = static::deckToProcess($gameProcess, $deck)->id;
        }
        $gameProcess->deckIds = $cardIds;

        $gameProcess->save();
        $gameProcess->game()->save($game);

        return $gameProcess;
    }

    /**
     * @param GameProcess $gameProcess
     * @param Book $book
     * @return BookProcess
     * @throws Exception
     */
    public static function bookToProcess(GameProcess $gameProcess, Book $book): BookProcess
    {
        $book->makeHidden([
            'sources', 'domes', 'scenes',
            'scope_id', 'owner_id', 'is_public',
            'created_at', 'updated_at', 'pivot'
        ]);
        $data = self::toArray($book, $book->translatable);
        $data['image'] = self::image($data['image']);
        /** @var BookProcess $bookProcess */
        $bookProcess = BookProcess::create($data);
        $ids = [];
        foreach ($book->cards as $card) {
            $ids[] = static::cardToProcess($gameProcess, $card)->id;
        }
        $bookProcess->card_ids = $ids;
        $ids = [];
        foreach ($book->scenes as $scene) {
            $ids[] = static::sceneToProcess($gameProcess, $scene)->id;
        }
        $bookProcess->scene_ids = $ids;
        $ids = [];
        foreach ($book->decks as $deck) {
            $ids[] = $deck->getKey();
        }
        $bookProcess->deck_ids = $ids;
        $ids = [];
        foreach ($book->sources as $source) {
            $ids[] = $source->getKey();
        }
        $bookProcess->source_ids = $ids;
        foreach ($book->domes as $dome) {
            $ids[] = $dome->getKey();
        }
        $bookProcess->dome_ids = $ids;
        $bookProcess->save();

        return $bookProcess;
    }

    /**
     * @param GameProcess $gameProcess
     * @param Dome $dome
     * @return DomeProcess
     * @throws Exception
     */
    public static function domeToProcess(GameProcess $gameProcess, Dome $dome): DomeProcess
    {
        $dome->makeHidden([
            'code',
            'is_public',
            'owner_id',
            'pivot',
            'created_at',
            'updated_at'
        ]);
        $data = self::toArray($dome, $dome->translatable, false);
        $data['image'] = self::image($data['image']);
        /** @var DomeProcess $domeProcess */
        $domeProcess = DomeProcess::create($data);
        static::prepareSpaceProcess($gameProcess, $domeProcess, $dome);
        $ids = [];
        foreach ($dome->areas as $area) {
            $ids[] = static::areaToProcess($gameProcess, $area)->id;
        }
        $domeProcess->area_ids = $ids;
        $ids = [];
        foreach ($dome->lands as $land) {
            $ids[] = static::landToProcess($gameProcess, $land)->id;
        }
        $domeProcess->land_ids = $ids;
        $ids = [];
        foreach ($dome->scenes as $scene) {
            $ids[] = static::sceneToProcess($gameProcess, $scene)->id;
        }
        $domeProcess->scene_ids = $ids;
        $domeProcess->save();
        $gameProcess->domes()->save($domeProcess);

        return $domeProcess;
    }

    /**
     * @param GameProcess $gameProcess
     * @param Land $land
     * @return LandProcess
     * @throws Exception
     */
    public static function landToProcess(GameProcess $gameProcess, Land $land): LandProcess
    {
        $land->makeHidden([
            'code',
            'is_public',
            'owner_id',
            'pivot',
            'sources',
            'created_at',
            'updated_at'
        ]);
        $data = self::toArray($land, $land->translatable, false);
        $data['image'] = self::image($data['image']);
        $landProcess = LandProcess::create($data);
        /** @var LandProcess $landProcess */
        static::prepareSpaceProcess($gameProcess, $landProcess, $land);
        $ids = [];
        foreach ($land->areas as $area) {
            $ids[] = $area->getKey();
        }
        $landProcess->area_ids = $ids;
        $ids = [];
        foreach ($land->scenes as $scene) {
            $ids[] = static::sceneToProcess($gameProcess, $scene)->id;
        }
        $landProcess->scene_ids = $ids;
        $landProcess->save();
        $gameProcess->lands()->save($landProcess);

        return $landProcess;
    }

    /**
     * @param GameProcess $gameProcess
     * @param Area $area
     * @return AreaProcess
     * @throws Exception
     */
    public static function areaToProcess(GameProcess $gameProcess, Area $area): AreaProcess
    {
        $area->makeHidden([
            'code',
            'is_public',
            'owner_id',
            'pivot',
            'created_at',
            'updated_at'
        ]);
        $data = self::toArray($area, $area->translatable, false);
        $data['image'] = self::image($data['image']);
        /** @var AreaProcess $areaProcess */
        $areaProcess = AreaProcess::create($data);
        static::prepareSpaceProcess($gameProcess, $areaProcess, $area);
        $ids = [];
        foreach ($area->scenes as $scene) {
            $ids[] = static::sceneToProcess($gameProcess, $scene)->id;
        }
        $areaProcess->scene_ids = $ids;
        $areaProcess->save();
        $gameProcess->areas()->save($areaProcess);

        return $areaProcess;
    }

    /**
     * @param GameProcess $gameProcess
     * @param Scene $scene
     * @return SceneProcess
     * @throws Exception
     */
    public static function sceneToProcess(GameProcess $gameProcess, Scene $scene): SceneProcess
    {
        $scene->makeHidden([
            'code',
            'is_public',
            'owner_id',
            'pivot',
            'created_at',
            'updated_at'
        ]);
        $data = self::toArray($scene, $scene->translatable, false);
        $data['image'] = self::image($data['image']);
        /** @var SceneProcess $sceneProcess */
        $sceneProcess = SceneProcess::create($data);
        static::prepareSpaceProcess($gameProcess, $sceneProcess, $scene);
        $sceneProcess->save();
        $gameProcess->scenes()->save($sceneProcess);

        return $sceneProcess;
    }

    /**
     * @param GameProcess $gameProcess
     * @param Deck $deck
     * @return DeckProcess
     * @throws Exception
     */
    public static function deckToProcess(GameProcess $gameProcess, Deck $deck): DeckProcess
    {
        $deck->makeHidden([
            'is_public',
            'owner_id',
            'created_at',
            'updated_at'
        ]);
        $data = self::toArray($deck, $deck->translatable, false);
        $data['image'] = self::image($data['image']);
        /** @var CardProcess $target */
        if (!$target = $gameProcess->cards()->where('id', $deck->card_id)->first()) {
            throw new Exception(
                'Target card for deck not found in sources! Deck ID: ' .
                $deck->getKey() .
            ' Card ID: ' . $deck->card_id);
        }
        $data['target_id'] = $target->id;
        /** @var CardProcess $scope */
        if (!$scope = $gameProcess->cards()->where('id', $deck->scope_id)->first()) {
            throw new Exception(
                'Scope card for deck not found in sources! Deck ID: ' .
                $deck->getKey() .
                ' Card ID: ' . $deck->scope_id);
        }
        $data['scope_id'] = $scope->id;
        $cards = [];
        foreach ($deck->cards as $card) {
            /** @var CardProcess $cardProcess */
            if (!$gameProcess->cards()->where('id', $card->getKey())->first()) {
                throw new Exception(
                    'Card for deck not found in sources! Deck ID: ' .
                    $deck->getKey() .
                    ' Card ID: ' . $card->getKey());
            }
            $cards[$card->getKey()] = $card->pivot->count;
        }
        $data['cards'] = $cards;
        /** @var DeckProcess */
        $deckProcess = DeckProcess::create($data);
        $gameProcess->decks()->save($deckProcess);

        return $deckProcess;
    }

    /**
     * @param GameProcess $gameProcess
     * @param Card $card
     * @return CardProcess
     */
    public static function cardToProcess(GameProcess $gameProcess, Card $card): CardProcess
    {
        $card->makeHidden(['is_public', 'owner_id', 'created_at', 'updated_at', 'pivot']);
        $data = self::toArray($card, $card->translatable);
        $data['image'] = self::image($data['image']);
        /** @var CardProcess $cardProcess */
        $cardProcess = CardProcess::updateOrCreate([
            'id' => $data['id'],
            Process::GAME_FOREIGN_KEY => $gameProcess->getKey()
        ], $data);
        $gameProcess->cards()->save($cardProcess);

        return $cardProcess;
    }

    /**
     * @param array $books
     * @param Book $book
     * @return void
     */
    protected static function prepareBooks(array &$books, Book $book): void
    {
        if (!array_key_exists($book->getKey(), $books)) {
            $books[$book->getKey()] = $book;
        }
        foreach ($book->sources as $source) {
            static::prepareBooks($books, $source);
        }
    }

    /**
     * @param GameProcess $gameProcess
     * @param SpaceProcessInterface $process
     * @param SpaceInterface $space
     * @return void
     * @throws Exception
     */
    protected static function prepareSpaceProcess(
        GameProcess           $gameProcess,
        SpaceProcessInterface $process,
        SpaceInterface        $space)
    {
        $ids = [];
        foreach ($space->cards as $card) {
            $ids[] = static::cardToProcess($gameProcess, $card)->id;
        }
        $process->card_ids = $ids;
        $ids = [];
        foreach ($space->decks as $deck) {
            $ids[] = static::deckToProcess($gameProcess, $deck)->id;
        }
        $process->deck_ids = $ids;
        $ids = [];
        foreach ($space->sources as $space) {
            $ids[] = $space->getKey();
        }
        $process->source_ids = $ids;
    }

    /**
     * @param Model $object
     * @param array $fields
     * @param bool $makeCurrent
     * @return array
     */
    protected static function toArray(Model $object, array $fields, bool $makeCurrent = true): array
    {
        $object->makeHidden($fields);
        $data = $object->toArray();
        foreach ($fields as $field) {
            $data[$field] = json_decode($object->getRawOriginal($field), true);
            if ($makeCurrent) {
                $data['current' . ucfirst($field)] = $data[$field];
            }
        }

        return $data;
    }

    /**
     * @param string|null $path
     * @return string|null
     */
    protected static function image(?string $path): ?string
    {
        return $path ? '/storage/'.$path : null;
    }
}
