<?php

namespace App\Traits;

trait Enum
{
    public static function tryFromName(string $name): ?static
    {
        $reflection = new \ReflectionEnum(static::class);

        return $reflection->hasCase($name)
            ? $reflection->getCase($name)->getValue()
            : null;
    }
}
