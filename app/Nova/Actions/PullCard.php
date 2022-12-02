<?php

namespace App\Nova\Actions;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use App\Models\Stack;
use App\Service\Shuffler;

class PullCard extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Get the displayable name of the action.
     *
     * @return string
     */
    public function name(): string
    {
        return __('Pull Card');
    }

    /**
     * Perform the action on the given models.
     *
     * @param ActionFields $fields
     * @param Collection $models
     * @return mixed
     * @throws Exception
     */
    public function handle(ActionFields $fields, Collection $models): mixed
    {
        /** @var Stack $model */
        foreach ($models as $model) {
            $log = Shuffler::pull($model);
        }
        return Action::message('Cards added to log');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(): array
    {
        return [];
    }
}
