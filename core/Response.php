<?php

namespace Core;

use JetBrains\PhpStorm\NoReturn;

class Response
{
    public const BAD_REQUEST = 400;

    public const NOT_FOUND = 404;

    public const SEE_OTHER = 303;

    public const SERVER_ERROR = 500;

    public const UNAUTHORIZED = 401;

    #[NoReturn]
    public static function abort(int $code = self::NOT_FOUND): void
    {
        http_response_code($code);
        view("codes.{$code}");
        exit();
    }

    #[NoReturn]
    public static function redirect(string $url): void
    {
        http_response_code(self::SEE_OTHER);
        header('location: '.$url);
        exit();
    }
}
