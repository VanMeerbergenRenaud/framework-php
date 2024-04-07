<?php

namespace Core\Middlewares;

use Core\Exceptions\MiddlewareNotFoundException;

class Middleware
{
    private const MAP = [
        'csrf' => CSRF::class,
        'auth' => Authenticated::class,
    ];

    public static function resolve(string $middleware): void
    {
        if (!array_key_exists($middleware, self::MAP)) {
            throw new MiddlewareNotFoundException("Middleware $middleware is not defined");
        }

        // self is a keyword used to refer to the current class, and it is used to access static properties and methods.
        $middleware = self::MAP[$middleware];

        (new $middleware)->handle(); // handle method from the CSRF class
    }
}