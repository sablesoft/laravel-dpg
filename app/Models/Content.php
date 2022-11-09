<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
 * @property-read Tag|null $scope
 * @property-read User|null $owner
 */
class Content extends Model
{
    use HasTranslations, Options;

    /**
     * @return BelongsTo
     */
    public function scope(): BelongsTo
    {
        return $this->belongsTo(Tag::class, 'scope_id');
    }

    /**
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
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
