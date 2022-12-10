<?php

namespace App\Enums;

trait EnumTrait
{
    /**
     * @return array
     */
    public static function options(): array
    {
        $options = [];
        foreach (static::cases() as $case) {
            $options[$case->value] = $case->label();
        }

        return $options;
    }
}
