<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use App\Service\ImageService;

/**
 * @property int|null $id
 * @property int|null $dome_id
 * @property int|null $card_id
 * @property string|null $filename
 * @property int|null $top_step
 * @property int|null $top
 * @property int|null $left_step
 * @property int|null $left
 * @property array|null $markers
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read string|null $card_image
 *
 * @property-read Dome|null $dome
 * @property-read Card|null $area
 */
class Area extends Content
{
    /**
     * @return BelongsTo
     */
    public function dome(): BelongsTo
    {
        return $this->belongsTo(Dome::class);
    }

    /**
     * @return string|null
     */
    public function getCardImageAttribute(): ?string
    {
        return $this->area?->image;
    }

    /**
     * @return BelongsTo
     */
    public function area(): BelongsTo
    {
        return $this->belongsTo(Card::class, 'card_id');
    }

    /**
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::saving(function (Area $area) {
            $area->name = $area->area->name;
            $area->owner()->associate(Auth::user());
            if (!$area->image) {
                $area->image = ImageService::createAreaFromMap($area);
            }
        });
    }
}
