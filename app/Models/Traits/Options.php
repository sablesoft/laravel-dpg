<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

trait Options
{
    /**
     * @return array
     */
    public static function options(): array
    {
        $options = [];
        $rows = static::getOptionsQuery()->get()->toArray();
        foreach ($rows as $row) {
            $name = $row['name'][App::currentLocale()] ??
                $row['name'][config('app.fallback_locale')];
            $options[$row['id']] = $name;
        }

        return $options;
    }

    /**
     * @return Builder
     */
    protected static function getOptionsQuery(): Builder
    {
        $query = static::select(['id', 'name']);
        if (get_called_class() == User::class) {
            return $query;
        }

        /** @var User $user */
        $user = Auth::user();
        if (!$user->isAdmin()) {
            $query->where('is_public', true)->orWhere('owner_id', $user->getKey());
        }

        return $query;
    }
}
