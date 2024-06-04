<?php

namespace Core\Middlewares;

use Core\Exceptions\MiddlewareNotFoundException;

class Middleware
{
    private const MAP = [
        'csrf' => CSRF::class,
        'guest' => Guest::class,
        'auth' => Auth::class,
    ];

    public static function resolve(string $name): void
    {
        if (!array_key_exists($name, self::MAP)) {
            throw new MiddlewareNotFoundException($name);
        }

        $name = self::MAP[$name];
        (new $name())->handle();
    }
}
