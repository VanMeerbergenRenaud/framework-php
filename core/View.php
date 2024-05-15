<?php

namespace Core;

class View
{
    public static function view(string $path, array $data = []): void
    {
        extract($data);

        $path = str_replace('.', '/', $path);

        require base_path("resources/views/{$path}.view.php");
    }

    public static function component(string $path, array $data = []): void
    {
        extract($data);

        $path = str_replace('.', '/', $path);

        require base_path("resources/views/components/{$path}.view.php");
    }

    public static function partials(string $path, array $data = []): void
    {
        extract($data);

        $path = str_replace('.', '/', $path);

        require base_path("resources/views/partials/{$path}.view.php");
    }
}
