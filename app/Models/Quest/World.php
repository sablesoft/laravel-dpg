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
 * @property array|null $files
 * @property array|null $filenames
 */
class World extends Model
{
    use Owner;

    const GAME_PATH = 'resources/js/Pages/QuestJS/Game/';

    /**
     * @var string
     */
    protected $table = 'quest_worlds';

    protected $casts = [
        'filenames' => 'array'
    ];

    protected $fillable = [
        'slug',
        'name',
        'desc',
        'files',
        'fileSettings',
        'fileData',
        'fileCode',
        'owner_id',
        'number',
    ];

    protected $appends = ['files'];

    /**
     * @return array
     */
    public function getFilesAttribute(): array
    {
        $data = [];
        foreach ($this->filenames as $file) {
            $data[$file] = $this->getFileContent($file);
        }
        return $data;
    }

    /**
     * @param array $files
     * @return self
     */
    public function setFilesAttribute(array $files): self
    {
        foreach ($files as $file => $content) {
            $this->putFileContent($file, $content);
        }

        return $this;
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

        static::creating(function (World $world) {
            $world->filenames = ['settings', 'data', 'code'];
            $world->owner()->associate(Auth::user());
        });
    }
}
