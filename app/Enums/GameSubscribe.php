<?php

namespace App\Enums;

enum GameSubscribe: int
{
    use EnumTrait;

    case Spectator = 0;
    case Player = 1;
    case Expert = 2;
    case Master = 3;

    /**
     * @return string
     */
    public function label(): string
    {
        return match($this) {
            GameSubscribe::Spectator => __('Spectator'),
            GameSubscribe::Player => __('Player'),
            GameSubscribe::Expert => __('Expert'),
            GameSubscribe::Master => __('Master'),
        };
    }

    public function code(): string
    {
        return match($this) {
            GameSubscribe::Spectator => 'spectator',
            GameSubscribe::Player => 'player',
            GameSubscribe::Expert => 'expert',
            GameSubscribe::Master => 'master',
        };
    }
}
