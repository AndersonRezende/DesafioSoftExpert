<?php

use DesafioSoftExpert\Core\Router;

require_once __DIR__ . '/../vendor/autoload.php';
$routes = require_once __DIR__ . '/../config/routes.php';

$router = new Router($routes);
$router->handlerRoute($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);