<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Translatable\HasTranslations;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Traits\Options;

/**
 * @property int|null $id
 * @property string|null $name
 * @property string|null $email
 * @property Carbon|null $email_verified_at
 * @property string|null $password
 * @property int|null $language_id
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Language|null $language
 * @property-read Book[]|null $books
 * @property-read Card[]|null $cards
 *
 * @property-read string|null $content_path
 * @property-read array $roles_names
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasTranslations,
        HasRoles, Notifiable, Options;

    const ROLE_ADMIN = 'Admin';

    /**
     * @var array|string[]
     */
    public array $translatable = ['name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->hasRole(static::ROLE_ADMIN);
    }

    /**
     * @return BelongsTo
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    /**
     * @return HasMany
     */
    public function books(): HasMany
    {
        return $this->hasMany(Book::class, 'owner_id');
    }

    /**
     * @return HasMany
     */
    public function cards(): HasMany
    {
        return $this->hasMany(Card::class, 'owner_id');
    }

    /**
     * @param string $code
     * @return $this
     */
    public function updateLanguage(string $code): static
    {
        $language = Language::where('code', '=', $code)->firstOrFail();
        $this->language()->associate($language);
        $this->save();

        return $this;
    }

    /**
     * @return array
     */
    public function getRolesNamesAttribute(): array
    {
        return $this->roles()->pluck('name')->toArray();
    }

    /**
     * @param string|null $locale
     * @return string|null
     */
    public function getContentPathAttribute(?string $locale = null): ?string
    {
        $locale = $locale ?: optional($this->language)->code;
        if (!$locale) {
            return null;
        }

        $path = '/users/' . $this->getKey() . '/' . $locale . '.json';

        return Storage::exists($path) ? $path : null;
    }
}
