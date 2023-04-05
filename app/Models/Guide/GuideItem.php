<?php

namespace App\Models\Guide;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Owner;
use Illuminate\Support\Str;

abstract class GuideItem extends Model
{
    use Owner;

    /**
     * Get the table associated with the model.
     *
     * @return string
     */
    public function getTable(): string
    {
        return 'guide_' . $this->table;
    }

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
