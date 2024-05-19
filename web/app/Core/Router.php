<?php

namespace DesafioSoftExpert\Core;

use DesafioSoftExpert\Controllers\ErrorController;

class Router
{
    protected array $routes;
    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function handlerRoute($method, $uri)
    {
        $route = $this->routes[$method][$uri] ?? null;
        if ($route) {
            [$controller, $action] = $route;
            (new $controller)->$action();
        } else {
            (new ErrorController())->index(StatusCodes::NOT_FOUND);
        }

    }
}