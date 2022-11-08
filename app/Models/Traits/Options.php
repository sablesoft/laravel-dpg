<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\App;

trait Options
{
    /**
     * @return array
     */
    public static function options(): array
    {
        $options = [];
        $rows = static::select(['id', 'name'])->get()->toArray();
        foreach ($rows as $row) {
            $name = $row['name'][App::currentLocale()] ??
                $row['name'][config('app.fallback_locale')];
            $options[$row['id']] = $name;
        }

        return $options;
    }
}
