<?php

namespace App\Enums;

enum GameSubscribe: int
{
    use EnumTrait;

    case Spectator = 0;
    case Player = 1;
    case Master = 100;

    /**
     * @return string
     */
    public function label(): string
    {
        return match($this) {
            GameSubscribe::Spectator => __('Spectator'),
            GameSubscribe::Player => __('Player'),
            GameSubscribe::Master => __('Master'),
        };
    }

    public function code(): string
    {
        return match($this) {
            GameSubscribe::Spectator => 'spectator',
            GameSubscribe::Player => 'player',
            GameSubscribe::Master => 'master',
        };
    }
}
