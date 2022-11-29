<?php

namespace App\Service;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;

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
    const DEFAULT_DISK = 'public';
    const CONFIG_PATH = 'filesystems.image';

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
        return (Storage::disk(static::diskName())->copy($oldImage, $newImage))?
            $newImage : null;
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
}
