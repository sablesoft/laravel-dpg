<?php

namespace App\Nova;

use App\Nova\Actions\CopyCard;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image as ImageManager;
use App\Nova\Filters\BooksFilter;
use App\Nova\Filters\ImageFilter;
use App\Nova\Filters\DecksFilter;
use App\Nova\Filters\ScopesFilter;

/**
 * @mixin \App\Models\Card
 */
class Card extends Content
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = \App\Models\Card::class;

    /**
     * @return string
     */
    public static function uriKey(): string
    {
        return 'units';
    }

    /**
     * @param NovaRequest $request
     * @param $query
     * @return Builder
     */
    public static function indexQuery(NovaRequest $request, $query): Builder
    {
        /** @var \App\Models\User $user */
        $user = $request->user();
        if (!$user->isAdmin()) {
            $query->where(function ($query) use ($user) {
                $query->where('is_public', '=', true)
                    ->orWhere('owner_id', '=', $user->getKey());
                return static::isBookSubscriber($query, $user);
            });
        }

        return $query;
    }

    /**
     * @param Builder $query
     * @param \App\Models\User $user
     * @return Builder
     */
    protected static function isBookSubscriber(Builder $query, \App\Models\User $user): Builder
    {
        $query->orWhere(function($query) use ($user) {
            return $query->whereHas('books.subscribers', function($query) use ($user) {
                $query->where('subscriber_id', $user->getKey());
            });
        });

        return $query;
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param Request $request
     * @return array
     */
    public function fields(Request $request): array
    {
        return [
            Text::make(__('Name'), 'name')
                ->nullable(false)->required()
                ->sortable()->rules('required', 'max:30'),
            Image::make(__('Image'), 'image')
                ->store(function (Request $request, $model, $attribute, $requestAttribute) {
                    /** @var UploadedFile $file */
                    $file = $request->file($requestAttribute);
                    $filename = $file->hashName(\App\Models\Card::STORAGE_PATH);
                    // resize by biggest dimension:
                    $width = $height = null;
                    $image = ImageManager::make($file->path());
                    $currentWidth = $image->width();
                    $currentHeight = $image->height();
                    if ($currentWidth > $currentHeight) {
                        $width = \App\Models\Card::IMAGE_WIDTH;
                    } else {
                        $height = \App\Models\Card::IMAGE_HEIGHT;
                    }
                    if ($currentWidth == $currentHeight) {
                        $height = \App\Models\Card::IMAGE_HEIGHT;
                    }
                    $image->resize($width, $height, function (Constraint $constraint) {
                        $constraint->aspectRatio();
                    })->encode($file->guessExtension());
                    Storage::disk('public')->put($filename, (string) $image);

                    return $filename;
                })
                ->disk('public')->nullable(true)->prunable(),
            BelongsTo::make(__('Scope'), 'scope', Card::class)
                ->nullable(true)->sortable(),
            Textarea::make(__('Desc'), 'desc')
                ->nullable()->alwaysShow(),
            Text::make(__('Books'), 'books_string')
                ->onlyOnDetail()->asHtml(),
            Number::make(__('Decks Count'), 'decks_count')
                ->hideWhenCreating()->hideWhenUpdating(),
            Text::make(__('Tags'), 'tags_string')
                ->hideWhenCreating()->hideWhenUpdating()->asHtml(),
            HasMany::make(__('Decks'), 'decks', Deck::class)
                ->sortable()->nullable(true),
            HasMany::make(__('Scoped Cards'), 'scopedCards', Card::class)
                ->sortable()->nullable(true),
            HasMany::make(__('Scoped Decks'), 'scopedDecks', Deck::class)
                ->sortable()->nullable(true),
            BelongsToMany::make(__('Tags'), 'tags', Card::class)
                ->sortable()->nullable(true),
            HasMany::make(__('Tagged Cards'), 'taggedCards', Card::class)
                ->sortable()->nullable(true),
            BelongsToMany::make(__('In Decks'), 'inDecks', Deck::class)
                ->fields(function () {
                    return [
                        Number::make(__('Count'), 'count')
                            ->nullable(false)->sortable()
                            ->required(true)
                            ->rules('required')
                            ->min(1)->step(1)->default(1),
                    ];
                })->sortable()->nullable(true),
            BelongsToMany::make(__('Books'), 'books', Book::class)
                ->sortable()->nullable(true),
            Boolean::make(__('Is Public'), 'is_public')
                ->nullable(false)->sortable(),
            BelongsTo::make(__('Owner'), 'owner', User::class)
                ->sortable()->hideWhenUpdating()->hideWhenCreating(),
            DateTime::make(__('Created At'), 'created_at')
                ->hideFromIndex()
                ->hideWhenCreating()->hideWhenUpdating()->sortable(true),
            DateTime::make(__('Updated At'), 'updated_at')
                ->hideFromIndex()
                ->hideWhenCreating()->hideWhenUpdating()->sortable(true)
        ];
    }

    /**
     * Build a "relatable" query for the given resource.
     *
     * This query determines which instances of the model may be attached to other resources.
     *
     * @param NovaRequest $request
     * @param  Builder  $query
     * @return Builder
     */
    public static function relatableQuery(NovaRequest $request, $query): Builder
    {
        /** @var \App\Models\Game $game */
        $game = $request->findModelQuery($request->get('resourceId'))->first();
        if (!is_object($game) || get_class($game) !== \App\Models\Game::class) {
            return $query;
        }
        if ($bookId = $game->book_id) {
            $query->whereHas('books', function($query) use ($bookId) {
                $query->where('book_id', $bookId);
            });
        }

        return static::setScope($request, $query);
    }

    /**
     * @param NovaRequest $request
     * @param Builder $query
     * @return Builder
     */
    protected static function setScope(NovaRequest $request, Builder $query): Builder
    {
        if (!$requestSegment = strtolower($request->segment(4))) {
            return $query;
        }
        $skip = ['update-fields'];
        if (in_array($requestSegment, $skip)) {
            return $query;
        }

        $locale = App::currentLocale();
        App::setLocale('en');
        $name = ucfirst($requestSegment);
        /** @var \App\Models\Card|null $card */
        $card = \App\Models\Card::query()
            ->whereRaw("name ilike '%\"$name\"%'")->first();
        if ($card && $card->name === $name) {
            $query->where('scope_id', $card->getKey());
        }
        App::setLocale($locale);

        return $query;
    }

    /**
     * Get the cards available for the request.
     *
     * @param Request $request
     * @return array
     */
    public function cards(Request $request): array
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param Request $request
     * @return array
     */
    public function filters(Request $request): array
    {
        return array_merge([
            new ScopesFilter(),
            new DecksFilter(),
            new BooksFilter(),
            new ImageFilter()
        ], parent::filters($request));
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param Request $request
     * @return array
     */
    public function lenses(Request $request): array
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param Request $request
     * @return array
     */
    public function actions(Request $request): array
    {
        return [
            CopyCard::make()->canRun(function () {
                return true;
            })
        ];
    }
}
