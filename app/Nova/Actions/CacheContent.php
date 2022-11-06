<?php

namespace App\Nova\Actions;

use App\Models\Content;
use App\Models\Language;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use App\Models\User;
use App\Models\Adventure;
use Laravel\Nova\Fields\Select;

class CacheContent extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param ActionFields $fields
     * @param Collection $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        if ($models->count() > 1) {
            return Action::danger('Please run this on only one user resource.');
        }

        /** @var User $user */
        $user = $models->first();
        $locale = $fields->get('locale');
        $content = [
            "locale" => $locale,
            'adventures' => []
        ];
        $currentLocale = App::currentLocale();
        App::setLocale($locale);

        $fields = ['adventures', 'decks', 'cards', 'tags', 'scopes'];
        foreach ($fields as $field) {
            /** @var Content $model */
            foreach ($user->$field as $model) {
                $content[$field][] = $model->export();
            }
        }
        Storage::put(
            'users/'. $user->getKey() .'/content.json',
            json_encode($content, JSON_UNESCAPED_UNICODE)
        );
        App::setLocale($currentLocale);

        return Action::message('Content Cached');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Select::make(__('Locale'), 'locale')
                ->options(Language::getList())->searchable()
        ];
    }
}
