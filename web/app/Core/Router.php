<?php

namespace DesafioSoftExpert\Core;

use DesafioSoftExpert\Controllers\ErrorController;
use DesafioSoftExpert\Error\Error;

class Router
{
    public static array $routes = array();

    public function __construct()
    {
        $this->buildUri();
    }

    private static function addRoute($method, $path, $action, $middleware = null)
    {
        self::$routes[] = array(
            'path' => $path,
            'controller' => $action[0],
            'action' => $action[1],
            'middleware' => $middleware,
            'method' => $method,
        );
    }

    public static function get($path, $action, $middleware = null)
    {
        self::addRoute('GET', $path, $action, $middleware);
    }

    public static function post($path, $action, $middleware = null)
    {
        self::addRoute('POST', $path, $action, $middleware);
    }

    private function getQueryString(): array
    {
        // O objetivo aqui é retornar os parametros da url em forma de array
        if (isset($_SERVER['QUERY_STRING'])) {
            $queryString = $_SERVER['QUERY_STRING'];
            parse_str($queryString, $params);
            return $params;
        }
        return [];
    }

    private function buildUri()
    {
        // O objetivo aqui é obter os dados da url, identificar para onde mandar a requisição e então repassar
        $requestUri = $_SERVER['REQUEST_URI'];
        $queryString = $this->getQueryString();
        $requestUri = preg_replace('/\?.*/', '', $requestUri);
        $url = preg_split('@/@', $requestUri, -1, PREG_SPLIT_NO_EMPTY);

        foreach (Router::$routes as $index => $route) {
            $path = preg_split('@/@', $route['path'], -1, PREG_SPLIT_NO_EMPTY);

            if ($url === $path && $_SERVER['REQUEST_METHOD'] === $route['method']) {
                $this->buildController($route['controller'], $route['action'], $route['middleware'], $queryString);
                die();
            }
        }
        Error::throwError(Error::NOT_FOUND, 'Não foi possível encontrar o recurso solicitado.');
    }

    private function buildController($controller, $action, $middleware, $queryString): void
    {
        // O objetivo aqui é executar o middleware, caso exista, e o controller
        $params = array_merge($_GET, $_POST);
        $request = new Request($params, $queryString);
        if ($middleware != null) {
            call_user_func([$middleware, 'handle'], $request);
        }
        (new $controller)->$action($middleware, $queryString);
    }
}