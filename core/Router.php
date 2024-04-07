<?php

namespace Core;

use Core\Middlewares\Middleware;
use Core\Exceptions\MiddlewareNotFoundException;

class Router
{
    private array $routes;

    public function get(string $url, array $action): Router
    {
        $http_method = 'GET';
        return $this->add(compact('url', 'action', 'http_method'));
    }

    public function post(string $url, array $action): Router
    {
        $http_method = 'POST';
        return $this->add(compact('url', 'action', 'http_method'));
    }

    public function patch(string $url, array $action): Router
    {
        $http_method = 'PATCH';
        return $this->add(compact('url', 'action', 'http_method'));
    }

    public function put(string $url, array $action): Router
    {
        $http_method = 'PUT';
        return $this->add(compact('url', 'action', 'http_method'));
    }

    public function delete(string $url, array $action): Router
    {
        $http_method = 'DELETE';
        return $this->add(compact('url', 'action', 'http_method'));
    }

    public function add(array $route_info): Router
    {
        $this->routes[] = $route_info;
        return $this;
    }

    public function csrf(): Router
    {
        $this->routes[array_key_last($this->routes)]['middlewares'][] = 'csrf';
        return $this;
    }

    public function only(string $who): Router {
        $this->routes[array_key_last($this->routes)]['middlewares'][] = $who;
        return $this;
    }

    public function routeToController(string $path, string $http_method): void
    {
        $route = array_values(array_filter(
            $this->routes,
            fn($v, $k) => $path === $v['url'] && strtoupper($http_method) === strtoupper($v['http_method']),
            ARRAY_FILTER_USE_BOTH
        ));

        if (empty($route)) {
            Response::abort();
        }

        if (isset($route[0]['middlewares'])) {
            foreach ($route[0]['middlewares'] as $middleware) {
                try {
                    Middleware::resolve($middleware);
                } catch (MiddlewareNotFoundException $exception) {
                    dd("Le middleware {${$exception->getMessage()}} n'existe pas");
                }
            }
        }

        $route = $route[0];
        $controller = new $route['action'][0]();
        $controller->{$route['action'][1]}();
    }
}