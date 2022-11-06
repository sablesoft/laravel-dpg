<?php

namespace App\Models;

use Carbon\Carbon;
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
}
