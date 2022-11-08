<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Models\Traits\Owner;
use App\Models\Traits\Options;

/**
 * @property string|null $name
 * @property string|null $desc
 * @property bool|null $is_public
 */
class Content extends Model
{
    use HasTranslations, Options, Owner;

    /**
     * Encode the given value as JSON.
     *
     * @param  mixed  $value
     * @return string
     */
    protected function asJson($value): string
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @var array|string[]
     */
    public array $translatable = ['name', 'desc'];

    /**
     * @return array
     */
    public function export(): array
    {
        $data = [];
        $map = ['name', 'desc', 'is_public'];
        foreach ($map as $key) {
            $data[$key] = $this->$key;
        }
        $data['tags'] = $this->tags()->get()->pluck('name')->toArray();

        return $data;
    }

    /**
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function (Content $content) {
            $content->owner()->associate(Auth::user());

        });
    }
}
