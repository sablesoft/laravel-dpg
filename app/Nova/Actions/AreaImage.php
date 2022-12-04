<?php

namespace App\Nova\Actions;

use App\Models\Area;
use App\Service\ImageService;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class AreaImage extends Action
{

    /**
     * Get the displayable name of the action.
     *
     * @return string
     */
    public function name(): string
    {
        return __('Prepare Image');
    }
    /**
     * Perform the action on the given models.
     *
     * @param ActionFields $fields
     * @param Collection $models
     * @return array
     */
    public function handle(ActionFields $fields, Collection $models): array
    {
        /** @var Area $area */
        $area = $models->first();
        $area->image = ImageService::createAreaFromMap($area);
        $area->save();

        return Action::message(__('Image Prepared. Reload page'));
    }

}
