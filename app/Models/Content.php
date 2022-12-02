<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Traits\Owner;
use App\Models\Traits\Options;

/**
 * @property int|null $id
 * @property int|null $scope_id
 * @property string|null $image
 * @property string|null $name
 * @property string|null $desc
 * @property int|null $owner_id
 * @property bool|null $is_public
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Card|null $scope
 * @property-read User|null $owner
 *
 * @method Builder isPublic(bool $isPublic = true, string $boolean = 'and')
 */
class Content extends Model
{
    use HasTranslations, Options, Owner;

    /**
     * @return BelongsTo
     */
    public function scope(): BelongsTo
    {
        return $this->belongsTo(Card::class, 'scope_id');
    }

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
     * @param Builder $query
     * @param bool $isPublic
     * @param string $boolean
     * @return Builder
     */
    public static function scopeIsPublic(Builder $query, bool $isPublic = true, string $boolean = 'and'): Builder
    {
        return $query->where('is_public', '=', $isPublic, $boolean);
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
