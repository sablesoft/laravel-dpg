<?php

namespace App\Enums;

enum GameStatus: int
{
    case Preview = 0;
    case Invite = 1;
    case Process = 2;
    case Closed = 3;

    /**
     * @return string
     */
    public function label(): string
    {
        return match($this) {
            GameStatus::Preview => __('Preview'),
            GameStatus::Invite => __('Invite'),
            GameStatus::Process => __('Process'),
            GameStatus::Closed => __('Closed')
        };
    }

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
