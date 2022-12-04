<?php

namespace App\Service;

use App\Models\Area;
use App\Models\Dome;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;
use App\Exceptions\ImageException;
use Symfony\Component\Mime\MimeTypes;

class ImageService
{
    const WIDTH = 300;
    const HEIGHT = 250;
    const BACK_WIDTH = 100;
    const BACK_RATIO = 1.4;
    const BACK_STORAGE = 'back';
    const BOOKS_STORAGE = 'book';
    const BOARDS_STORAGE = 'board';
    const CARDS_STORAGE = 'card';
    const AREAS_STORAGE = 'area';
    const DOMES_STORAGE = 'area';
    const DEFAULT_DISK = 'public';
    const CONFIG_PATH = 'filesystems.image';

    /**
     * @param UploadedFile $file
     * @param Dome $dome
     * @return string|null
     */
    public static function uploadDomeImage(UploadedFile $file, Dome $dome): ?string
    {
        $filename = $file->hashName(static::DOMES_STORAGE);
        $image = Image::make($file->path());
        $image->encode($file->guessExtension());

        return static::store($filename, (string) $image) ? $filename : null;
    }

    /**
     * @param Area $area
     * @return string|null
     */
    public static function createAreaFromMap(Area $area): ?string
    {
        if (!$dome = $area->dome) {
            return null;
        }
        if (!$map = $dome->image) {
            return null;
        }
        if (!$dome->area_height || !$dome->area_width) {
            return null;
        }
        $image = Image::make($map);
        $image->crop($dome->area_width, $dome->area_height, $area->left, $area->top);
        $image->encode();
        $filename = static::generateFilename(static::AREAS_STORAGE, $image);

        return static::store($filename, (string) $image) ? $filename : null;
    }

    /**
     * @param UploadedFile $file
     * @param Dome $dome
     * @return string|null
     */
    public static function uploadAreaImage(UploadedFile $file, Dome $dome): ?string
    {
        $filename = $file->hashName(static::AREAS_STORAGE);
        $image = Image::make($file->path());
        $image->resize($dome->area_width, $dome->area_height)->encode($file->guessExtension());

        return static::store($filename, (string) $image) ? $filename : null;
    }

    /**
     * @param UploadedFile $file
     * @return string|null
     */
    public static function uploadCardImage(UploadedFile $file): ?string
    {
        $filename = $file->hashName(static::CARDS_STORAGE);
        // resize by biggest dimension:
        $width = $height = null;
        $image = Image::make($file->path());
        $currentWidth = $image->width();
        $currentHeight = $image->height();
        if ($currentWidth > $currentHeight) {
            $width = static::WIDTH;
        } else {
            $height = static::HEIGHT;
        }
        if ($currentWidth == $currentHeight) {
            $height = static::HEIGHT;
        }
        $image->resize($width, $height, function (Constraint $constraint) {
            $constraint->aspectRatio();
        })->encode($file->guessExtension());
        return static::store($filename, (string) $image) ? $filename : null;
    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    public static function uploadCardBack(UploadedFile $file): ?string
    {
        $filename = $file->hashName(static::BACK_STORAGE);
        $image = Image::make($file->path())
            ->resize(static::backWidth(), static::backHeight())->encode($file->guessExtension());
        return static::store($filename, (string) $image) ? $filename : null;
    }

    /**
     * @param UploadedFile $file
     * @return string|null
     */
    public static function uploadBookImage(UploadedFile $file): ?string
    {
        $filename = $file->hashName(static::BOOKS_STORAGE);
        $image = Image::make($file->path())
            ->resize(static::WIDTH, static::HEIGHT, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode($file->guessExtension());
        return static::store($filename, (string) $image) ? $filename : null;
    }

    /**
     * @param UploadedFile $file
     * @return string|null
     */
    public static function uploadBoardImage(UploadedFile $file): ?string
    {
        $filename = $file->hashName(static::BOARDS_STORAGE);
        return static::store($filename, $file->getContent()) ? $filename : null;
    }

    /**
     * @param null|string $oldImage
     * @return string|null
     * @throws ImageException
     */
    public static function copyImage(?string $oldImage): ?string
    {
        if (!$oldImage) {
            return null;
        }
        [$path, $ext] = explode('.', $oldImage);
        $path = explode('/', trim($path, '/'));
        array_pop($path);
        $newImage = implode('/', $path) .'/'. Str::random(40) .'.'. $ext;
        if (!Storage::disk(static::diskName())->copy($oldImage, $newImage)) {
            throw new ImageException('Image copy error');
        }

        return $newImage;
    }

    /**
     * @return string
     */
    public static function diskName(): string
    {
        return config(static::CONFIG_PATH .'.disk', static::DEFAULT_DISK);
    }

    /**
     * @return float
     */
    public static function backWidth(): float
    {
        return (float) static::BACK_WIDTH;
    }

    /**
     * @return float
     */
    public static function backHeight(): float
    {
        return static::backWidth() * static::BACK_RATIO;
    }

    /**
     * @param string $path
     * @param string $content
     * @return bool
     */
    protected static function store(string $path, string $content): bool
    {
        return Storage::disk(static::diskName())->put($path, $content);
    }

    /**
     * @param string $path
     * @param \Intervention\Image\Image $image
     * @return string
     */
    protected static function generateFilename(string $path, \Intervention\Image\Image $image): string
    {
        $path = rtrim($path, '/').'/';
        $hash = Str::random(40);
        $ext = MimeTypes::getDefault()->getExtensions($image->mime())[0];
        $ext = $ext ? ".$ext" : null;

        return $path.$hash.$ext;
    }
}
