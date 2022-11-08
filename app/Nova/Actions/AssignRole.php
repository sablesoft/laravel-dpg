<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Collection;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Spatie\Permission\Models\Role;
use App\Models\User;

class AssignRole extends Action
{
    use InteractsWithQueue, Queueable;

    const FIELD_ROLE = 'role';

    /**
     * Perform the action on the given models.
     *
     * @param ActionFields $fields
     * @param Collection $models
     * @return array
     */
    public function handle(ActionFields $fields, Collection $models): array
    {
        /** @var User $model */
        foreach ($models as $model) {
            $model->assignRole($fields->get(self::FIELD_ROLE));
        }

        return Action::message('Role assigned');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            Select::make(__('Role'), self::FIELD_ROLE)
                ->options(function () {
                    return Role::all()->pluck('name', 'name');
                })->rules('required')->required(),
        ];
    }
}
