<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Intervention\Image\Facades\Image as ImageManager;
use App\Nova\Filters\CardsFilter;
use App\Nova\Filters\ImageFilter;
use App\Nova\Filters\OwnersFilter;
use App\Nova\Filters\ScopesFilter;
use App\Nova\Filters\IsPublicFilter;
use Laravel\Nova\Http\Requests\NovaRequest;

/**
 * @mixin \App\Models\Book
 */
class Book extends Content
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = \App\Models\Book::class;

    /**
     * @param NovaRequest $request
     * @param Builder $query
     * @return Builder
     */
    public static function indexQuery(NovaRequest $request, $query): Builder
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $query->allowedToSee();
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
                    $filename = $file->hashName('book_image');
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
            Number::make(__('Unique Cards'), 'cards_count')
                ->hideWhenUpdating()->hideWhenCreating(),
            Text::make(__('Tags'), 'tags_string')
                ->hideFromIndex()->hideWhenCreating()->hideWhenUpdating()->asHtml(),
            Textarea::make(__('Desc'), 'desc')->nullable()->alwaysShow(),
            HasMany::make(__('Decks'), 'decks', Deck::class)
                ->sortable()->nullable(true),
            Image::make(__('Cards Back'), 'cards_back')
                ->store(function (Request $request, $model, $attribute, $requestAttribute) {
                    /** @var UploadedFile $file */
                    $file = $request->file($requestAttribute);
                    $filename = $file->hashName('card_back');
                    $width = \App\Models\Card::width();
                    $height = \App\Models\Card::height();
                    $image = ImageManager::make($file->path())
                        ->resize($width, $height)->encode($file->guessExtension());
                    Storage::disk('public')->put($filename, (string) $image);

                    return $filename;
                })->maxWidth(\App\Models\Card::width())->disk('public')->prunable()
                ->nullable(true)->hideFromIndex(),
            BelongsToMany::make(__('Cards'), 'cards', Card::class)
                ->sortable()->nullable(true),
            Boolean::make(__('Is Public'), 'is_public')
                ->nullable(false)->sortable(),
            BelongsTo::make(__('Owner'), 'owner', User::class)
                ->sortable()
                ->hideWhenUpdating()->hideWhenCreating(),
            DateTime::make(__('Created At'), 'created_at')
                ->hideFromIndex()
                ->hideWhenCreating()->hideWhenUpdating()->sortable(true),
            DateTime::make(__('Updated At'), 'updated_at')
                ->hideFromIndex()
                ->hideWhenCreating()->hideWhenUpdating()->sortable(true),
            BelongsToMany::make(__('Subscribers'), 'subscribers', User::class)
                ->fields(function () {
                    return [
                        Select::make(__('Type'), 'type')
                            ->nullable(false)->sortable()
                            ->default(function($request) { return 0; })
                            ->options(\App\Models\Book::subscriberTypeOptions())
                            ->displayUsingLabels(),
                    ];
                })->sortable()->nullable(true),
        ];
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
        return [
            new IsPublicFilter(),
            new OwnersFilter(),
            new ScopesFilter(),
            new CardsFilter(),
            new ImageFilter()
        ];
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
