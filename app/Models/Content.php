<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * @property string|null $name
 * @property string|null $desc
 */
class Content extends Model
{
    use HasTranslations;

    /**
     * @var array|string[]
     */
    public array $translatable = ['name', 'desc'];

    public static function boot()
    {
        parent::boot();

        static::creating(function (Content $content) {
            $content->owner()->associate(Auth::user());
        });
    }
}
