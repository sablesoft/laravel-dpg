<?php

namespace App\Models\Quest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Owner;
use Illuminate\Support\Facades\File;

/**
 * @property int|null $id
 * @property string|null $slug
 * @property string|null $name
 * @property string|null $desc
 * @property string|null $fileSettings
 * @property string|null $fileData
 * @property string|null $fileCode
 */
class World extends Model
{
    const GAME_PATH = 'resources/js/Pages/QuestJS/Game/';
    use Owner;

    /**
     * @var string
     */
    protected $table = 'quest_worlds';

    protected $fillable = [
        'slug',
        'name',
        'desc',
        'fileSettings',
        'fileData',
        'fileCode',
        'owner_id',
        'number',
    ];

    protected $appends = ['fileSettings', 'fileData', 'fileCode'];

    /**
     * @return string|null
     */
    public function getFileSettingsAttribute(): ?string
    {
        return $this->getFileContent('settings');
    }

    /**
     * @param string $content
     * @return $this
     */
    public function setFileSettingsAttribute(string $content): self
    {
        return $this->putFileContent('settings', $content);
    }

    /**
     * @return string|null
     */
    public function getFileCodeAttribute(): ?string
    {
        return $this->getFileContent('code');
    }

    /**
     * @param string $content
     * @return $this
     */
    public function setFileCodeAttribute(string $content): self
    {
        return $this->putFileContent('code', $content);
    }

    /**
     * @return string|null
     */
    public function getFileDataAttribute(): ?string
    {
        return $this->getFileContent('data');
    }

    /**
     * @param string $content
     * @return $this
     */
    public function setFileDataAttribute(string $content): self
    {
        return $this->putFileContent('data', $content);
    }

    /**
     * @param string $file
     * @return string|null
     */
    protected function getFileContent(string $file): ?string
    {
        if (!$this->slug) {
            return null;
        }
        return File::get(base_path(static::GAME_PATH . $this->slug . '/' . $file . '.js'));
    }

    /**
     * @param string $file
     * @param string $content
     * @return World
     */
    protected function putFileContent(string $file, string $content): self
    {
        if (!$this->slug) {
            return $this;
        }
        File::put(base_path(static::GAME_PATH . $this->slug . '/' . $file . '.js'), $content);

        return $this;
    }


    /**
     * @return void
     */
    public static function boot(): void
    {
        parent::boot();

        static::creating(function (World $item) {
            $item->owner()->associate(Auth::user());
        });
    }
}
