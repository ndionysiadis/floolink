<?php

namespace App\Enums;

enum LinkType: string
{
    case DEFAULT = 'default';
    case NEVER = 'never';
    case TIMED = 'timed';

    public function shouldSelfDestruct(): bool
    {
        return match($this) {
            self::DEFAULT => true,
            self::NEVER, self::TIMED => false,
        };
    }
}
