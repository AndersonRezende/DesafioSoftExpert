<?php

namespace DesafioSoftExpert\Core;

class App
{
    private Router $router;
    public function __construct()
    {
        $routes = require_once __DIR__ . "/../../config/routes.php";
        $this->router = new Router($routes);
    }

    public function run() {
        $this->router->handlerRoute($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
    }
}