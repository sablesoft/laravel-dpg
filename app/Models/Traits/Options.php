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
            $options[$row['id']] = $row['name'][App::currentLocale()];
        }

        return $options;
    }
}
