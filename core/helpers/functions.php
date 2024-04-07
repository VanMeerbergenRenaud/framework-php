<?php

use Core\View;

function dd(mixed ...$vars): void // the ... operator is called the splat operator, and it allows you to pass an array of many arguments to a function (as you want)
{
    echo '<pre>';
        foreach ($vars as $var) {
            var_dump($var);
            echo '<hr>';
        }
    echo '</pre>';
    die();
}

function view(string $path, array $data = []): void
{
    View::view($path, $data);
}

function component(string $path, array $data = []): void
{
    View::component($path, $data);
}

function partial(string $path, array $data = []): void
{
    View::partial($path, $data);
}

function base_path(string $path = ''): string
{
    return BASE_PATH . ($path ? ('/' . $path) : $path);
}

function public_path(string $path = ''): string
{
    $server = 'Http' . (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 's' : '') . '://' . $_SERVER['SERVER_NAME'];
    return "{$server}/$path";
}

function method(string $method): void
{
    echo <<<HTML
        <input type="hidden" name="_method" value="$method"/>
    HTML;
}

function get_csrf_token(): string
{
    try {
        return bin2hex(random_bytes(32));
    } catch (Exception $e) {
        die($e->getMessage());
    }
}

function csrf_token(): void
{
    $_SESSION['csrf_token'] = $_SESSION['csrf_token'] ?? bin2hex(random_bytes(32));

    echo <<<HTML
        <input type="hidden" name="_csrf" value="{$_SESSION['csrf_token']}">
    HTML;
}