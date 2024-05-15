<?php

namespace Core;

use Core\Exceptions\MiddlewareNotFoundException;
use Core\Middlewares\Middleware;

class Router
{
    private array $routes;

    public function get(string $path, array $action): Router
    {
        return $this->add($path, $action, 'GET');
    }

    private function add(string $path, array $action, string $request_method): Router
    {
        $this->routes[] = compact('path', 'action', 'request_method');

        return $this;
    }

    public function post(string $path, array $action): Router
    {
        return $this->add($path, $action, 'POST');
    }

    public function patch(string $path, array $action): Router
    {
        return $this->add($path, $action, 'PATCH');
    }

    public function put(string $path, array $action): Router
    {
        return $this->add($path, $action, 'PUT');
    }

    public function delete(string $path, array $action): Router
    {
        return $this->add($path, $action, 'DELETE');
    }

    public function csrf(): Router
    {
        $this->routes[array_key_last($this->routes)]['middlewares'][] = 'csrf';

        return $this;
    }

    public function only(string $who): Router
    {
        $this->routes[array_key_last($this->routes)]['middlewares'][] = $who;

        return $this;
    }

    public function route_to_controller(mixed $request_method, string $request_uri): void
    {
        $route =
            array_values(
                array_filter(
                    $this->routes,
                    fn($v, $k) => $v['path'] === $request_uri
                        && strtoupper($v['request_method']) === strtoupper($request_method),
                    ARRAY_FILTER_USE_BOTH
                )
            );

        if (empty($route)) {
            Response::abort();
        }
        $route = $route[0];
        if (isset($route['middlewares'])) {
            foreach ($route['middlewares'] as $middleware) {
                try {
                    Middleware::resolve($middleware);
                } catch (MiddlewareNotFoundException $exception) {
                    dd("Le middleware {$exception->getMessage()} n'existe pas sur l'application");
                }
            }
        }

        $action = $route['action'];
        [$controller_name, $method_name] = $action;

        $controller = new $controller_name();
        $controller->{$method_name}();
    }
}
