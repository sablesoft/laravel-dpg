<?php

namespace App\Nova\Actions;

use App\Service\Shuffler;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;
use App\Models\Stack;

class ShuffleStack extends Action
{
    use InteractsWithQueue, Queueable;

    const OPTION_ALL = 0;
    const OPTION_PACK = 1;
    const OPTION_DISCARD = 2;
    const FIELD_TYPE = 'type';

    /**
     * Perform the action on the given models.
     *
     * @param ActionFields $fields
     * @param Collection $models
     * @return array
     */
    public function handle(ActionFields $fields, Collection $models): array
    {
        $type = $fields->get(self::FIELD_TYPE);
        /** @var Stack $model */
        foreach ($models as $model) {
            switch ($type) {
                case self::OPTION_ALL:
                    $model = Shuffler::shuffle($model);
                    break;
                case self::OPTION_PACK:
                    $model = Shuffler::shuffle($model, 'pack');
                    break;
                case self::OPTION_DISCARD:
                    $model = Shuffler::shuffle($model, 'discard');
                    break;
            }
            $model->save();
        }

        return Action::message('Stacks are shuffled');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            Select::make(__('Type'), self::FIELD_TYPE)
                ->options([
                    self::OPTION_ALL => 'All',
                    self::OPTION_PACK => 'Pack',
                    self::OPTION_DISCARD => 'Discard'
                ])->required()->default(0)->rules('required')
        ];
    }
}
