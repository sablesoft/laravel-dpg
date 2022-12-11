<?php /** @noinspection PhpPossiblePolymorphicInvocationInspection */

/** @noinspection PhpUndefinedMethodInspection */

namespace App\Service;

use Exception;
use Illuminate\Support\Facades\App;
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
     * @param string|null $locale
     * @return GameProcess
     * @throws Exception
     */
    public static function initProcess(Game $game, ?string $locale = null): GameProcess
    {
        static::dropProcess($game);

        if (!$locale) {
            $locale = App::currentLocale();
        }
        $game->makeHidden([
            'process_id',
            'owner_id', 'quest_id', 'created_at',
            'is_public', 'status', 'updated_at'
        ]);
        $data = self::translate($game->toArray(), $game->translatable, $locale);
        $data['image'] = self::image($data['image']);
        $data['scope_name'] = __('Game');

        /** @var GameProcess $gameProcess */
        $gameProcess = GameProcess::create($data);
        $gameProcess->quest_id = static::cardToProcess($gameProcess, $game->quest, $locale)->id;
        $ids = [];
        foreach ($game->heroes as $hero) {
            $ids[] = static::cardToProcess($gameProcess, $hero, $locale)->id;
        }
        $gameProcess->hero_ids = $ids;
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
            $gameProcess->books()->save(static::bookToProcess($gameProcess, $book, $locale));
        }
        // prepare decks, domes and areas:
        foreach ($books as $book) {
            foreach ($book->decks as $deck) {
                static::deckToProcess($gameProcess, $deck, $locale);
            }
            foreach ($book->domes as $dome) {
                static::domeToProcess($gameProcess, $dome, $locale);
            }
        }
        $ids = [];
        foreach ($game->cards as $card) {
            $ids[] = static::cardToProcess($gameProcess, $card, $locale)->id;
        }
        $gameProcess->card_ids = $ids;
        $ids = [];
        foreach ($game->decks as $deck) {
            $ids[] = static::deckToProcess($gameProcess, $deck, $locale)->id;
        }
        $gameProcess->deck_ids = $ids;
        foreach (['dome', 'area', 'land', 'deck', 'card', 'scene'] as $entity) {
            $field = "open_${entity}_ids";
            $gameProcess->$field = null;
        }

        $gameProcess->save();
        $gameProcess->game()->save($game);

        return $gameProcess;
    }

    /**
     * @param GameProcess $gameProcess
     * @param Book $book
     * @param string|null $locale
     * @return BookProcess
     * @throws Exception
     */
    public static function bookToProcess(GameProcess $gameProcess, Book $book, ?string $locale = null): BookProcess
    {
        if (!$locale) {
            $locale = App::currentLocale();
        }
        $book->makeHidden([
            'sources',
            'scope_id', 'owner_id', 'is_public',
            'created_at', 'updated_at', 'pivot'
        ]);
        $data = self::translate($book->toArray(), $book->translatable, $locale);
        $data['image'] = self::image($data['image']);
        /** @var BookProcess $bookProcess */
        $bookProcess = BookProcess::create($data);
        $ids = [];
        foreach ($book->cards as $card) {
            $ids[] = static::cardToProcess($gameProcess, $card, $locale)->id;
        }
        $bookProcess->card_ids = $ids;
        $ids = [];
        foreach ($book->scenes as $scene) {
            $ids[] = static::sceneToProcess($gameProcess, $scene, $locale)->id;
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
     * @param string|null $locale
     * @return DomeProcess
     * @throws Exception
     */
    public static function domeToProcess(GameProcess $gameProcess, Dome $dome, ?string $locale = null): DomeProcess
    {
        if (!$locale) {
            $locale = App::currentLocale();
        }
        $dome->makeHidden([
            'code',
            'area_mask',
            'is_public',
            'owner_id',
            'pivot',
            'created_at',
            'updated_at'
        ]);
        $data = self::translate($dome->toArray(), $dome->translatable, $locale);
        $data['image'] = self::image($data['image']);
        /** @var DomeProcess $domeProcess */
        $domeProcess = DomeProcess::create($data);
        static::prepareSpaceProcess($gameProcess, $domeProcess, $dome, $locale);
        $ids = [];
        foreach ($dome->areas as $area) {
            $ids[] = static::areaToProcess($gameProcess, $area, $locale)->id;
        }
        $domeProcess->area_ids = $ids;
        $ids = [];
        foreach ($dome->lands as $land) {
            $ids[] = static::landToProcess($gameProcess, $land, $locale)->id;
        }
        $domeProcess->land_ids = $ids;
        $domeProcess->save();
        $gameProcess->domes()->save($domeProcess);

        return $domeProcess;
    }

    /**
     * @param GameProcess $gameProcess
     * @param Land $land
     * @param string|null $locale
     * @return LandProcess
     * @throws Exception
     */
    public static function landToProcess(GameProcess $gameProcess, Land $land, ?string $locale = null): LandProcess
    {
        if (!$locale) {
            $locale = App::currentLocale();
        }
        $land->makeHidden([
            'code',
            'is_public',
            'owner_id',
            'pivot',
            'sources',
            'created_at',
            'updated_at'
        ]);
        $data = self::translate($land->toArray(), $land->translatable, $locale);
        $data['image'] = self::image($data['image']);
        $landProcess = LandProcess::create($data);
        /** @var LandProcess $landProcess */
        static::prepareSpaceProcess($gameProcess, $landProcess, $land, $locale);
        $ids = [];
        foreach ($land->areas as $area) {
            $ids[] = $area->getKey();
        }
        $landProcess->area_ids = $ids;
        $landProcess->save();
        $gameProcess->lands()->save($landProcess);

        return $landProcess;
    }

    /**
     * @param GameProcess $gameProcess
     * @param Area $area
     * @param string|null $locale
     * @return AreaProcess
     * @throws Exception
     */
    public static function areaToProcess(GameProcess $gameProcess, Area $area, ?string $locale = null): AreaProcess
    {
        if (!$locale) {
            $locale = App::currentLocale();
        }
        $area->makeHidden([
            'code',
            'is_public',
            'owner_id',
            'pivot',
            'created_at',
            'updated_at'
        ]);
        $data = self::translate($area->toArray(), $area->translatable, $locale);
        $data['image'] = self::image($data['image']);
        /** @var AreaProcess $areaProcess */
        $areaProcess = AreaProcess::create($data);
        static::prepareSpaceProcess($gameProcess, $areaProcess, $area, $locale);
        $areaProcess->save();
        $gameProcess->areas()->save($areaProcess);

        return $areaProcess;
    }

    /**
     * @param GameProcess $gameProcess
     * @param Scene $scene
     * @param string|null $locale
     * @return SceneProcess
     */
    public static function sceneToProcess(GameProcess $gameProcess, Scene $scene, ?string $locale = null): SceneProcess
    {
        if (!$locale) {
            $locale = App::currentLocale();
        }
        $scene->makeHidden([
            'code',
            'is_public',
            'owner_id',
            'pivot',
            'created_at',
            'updated_at'
        ]);
        $data = self::translate($scene->toArray(), $scene->translatable, $locale);
        $data['image'] = self::image($data['image']);
        /** @var SceneProcess $sceneProcess */
        $sceneProcess = SceneProcess::create($data);
        $sceneProcess->save();
        $gameProcess->scenes()->save($sceneProcess);

        return $sceneProcess;
    }

    /**
     * @param GameProcess $gameProcess
     * @param Deck $deck
     * @param string|null $locale
     * @return DeckProcess
     * @throws Exception
     */
    public static function deckToProcess(GameProcess $gameProcess, Deck $deck, ?string $locale = null): DeckProcess
    {
        if (!$locale) {
            $locale = App::currentLocale();
        }
        $deck->makeHidden([
            'is_public',
            'owner_id',
            'created_at',
            'updated_at'
        ]);
        $data = self::translate($deck->toArray(), $deck->translatable, $locale);
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
     * @param string|null $locale
     * @return CardProcess
     */
    public static function cardToProcess(GameProcess $gameProcess, Card $card, ?string $locale = null): CardProcess
    {
        if (!$locale) {
            $locale = App::currentLocale();
        }
        $card->makeHidden(['is_public', 'owner_id', 'created_at', 'updated_at', 'pivot']);
        $data = $card->toArray();
        $data['image'] = self::image($data['image']);
        $data['scope_image'] = self::image(optional($card->scope)->image);
        $data = self::translate($data, $card->translatable, $locale);
        $overrideFields = ['name', 'desc'];
        foreach ($overrideFields as $field) {
            $data['current_' . $field] = $data[$field];
        }
        /** @var CardProcess $cardProcess */
        $cardProcess = CardProcess::create($data);
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
     * @param string $locale
     * @return void
     * @throws Exception
     */
    protected static function prepareSpaceProcess(
        GameProcess           $gameProcess,
        SpaceProcessInterface $process,
        SpaceInterface        $space,
        string                $locale)
    {
        $ids = [];
        foreach ($space->cards as $card) {
            $ids[] = static::cardToProcess($gameProcess, $card, $locale)->id;
        }
        $process->card_ids = $ids;
        $ids = [];
        foreach ($space->decks as $deck) {
            $ids[] = static::deckToProcess($gameProcess, $deck, $locale)->id;
        }
        $process->deck_ids = $ids;
        $ids = [];
        foreach ($space->sources as $space) {
            $ids[] = $space->getKey();
        }
        $process->source_ids = $ids;
    }

    /**
     * @param array $data
     * @param array $fields
     * @param string $locale
     * @return array
     */
    protected static function translate(array $data, array $fields, string $locale): array
    {
        $fallback = config('app.fallback_locale');
        foreach ($fields as $field) {
            if (empty($data[$field])) {
                continue;
            }
            if (empty($data[$field][$locale])) {
                if (empty($data[$field][$fallback])) {
                    $data[$field] = null;
                    continue;
                }
                $data[$field] = $data[$field][$fallback];
            } else {
                $data[$field] = $data[$field][$locale];
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
