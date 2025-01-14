<?php

namespace App\Enums;

enum LinkType: string
{
    case DEFAULT = 'default';
    case NEVER = 'never';
    case TIMED = 'timed';
    case CUSTOM = 'custom';
    public function shouldSelfDestruct(): bool
    {
        return $this === self::DEFAULT;
    }
}
