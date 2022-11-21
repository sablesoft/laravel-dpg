<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as ImageManager;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use App\Nova\Filters\BooksFilter;
use App\Nova\Filters\DecksFilter;
use App\Nova\Filters\ScopesFilter;
use Laravel\Nova\Http\Requests\NovaRequest;

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
                    $filename = $file->hashName('card_image');
                    $width = \App\Models\Card::IMAGE_WIDTH;
                    $height = \App\Models\Card::IMAGE_HEIGHT;
                    $image = ImageManager::make($file->path())
                        ->resize($width, $height, function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        })->encode($file->guessExtension());
                    Storage::disk('public')->put($filename, (string) $image);

                    return $filename;
                })->disk('public')->prunable()->nullable(true)->hideFromIndex(),
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
                ->hideFromIndex()
                ->nullable(false)->sortable(),
            BelongsTo::make(__('Owner'), 'owner', User::class)
                ->sortable()->hideFromIndex()
                ->hideWhenUpdating()->hideWhenCreating(),
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
            new BooksFilter()
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
        return [];
    }
}
