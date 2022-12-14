<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

/**
 * @property int|null $id
 * @property string|null $code
 * @property string|null $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read User[]|null $users
 */
class Language extends Model
{
    use HasFactory, HasTranslations;

    /**
     * @var array|string[]
     */
    public array $translatable = ['name'];

    /**
     * Encode the given value as JSON.
     *
     * @param  mixed  $value
     * @return string
     */
    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * @return array
     */
    public static function getList(): array
    {
        return Language::select('code', 'name')->get()->map(function($language) {
            return [$language->code => $language->name];
        })->collapse()->toArray();
    }

    /**
     * @return array
     */
    public static function getAllCodesList(): array
    {
        $list = [];
        $path = storage_path('flags');
        foreach (File::allFiles($path) as $file) {
            $code = $file->getFilenameWithoutExtension();
            $list[$code] = $code;
        }

        return $list;
    }
}
