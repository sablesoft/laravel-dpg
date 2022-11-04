<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Traits\Owner;

class OwnerObserver
{
    /**
     * @param Model|Owner $model
     * @return void
     * @noinspection PhpDocSignatureInspection
     */
    public function creating(Model $model)
    {
        $model->owner()->associate(Auth::user());
    }
}
