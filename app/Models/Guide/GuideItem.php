<?php

namespace App\Models\Guide;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Owner;

abstract class GuideItem extends Model
{
    use Owner;

    /**
     * @return void
     */
    public static function boot(): void
    {
        parent::boot();

        static::creating(function (GuideItem $item) {
            $item->owner()->associate(Auth::user());
        });
    }
}
