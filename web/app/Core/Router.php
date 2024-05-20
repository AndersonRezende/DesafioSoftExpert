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

    /**
     * Facilitador para adicionar rotas
     * @param $method
     * @param $path
     * @param $action
     * @param $middleware
     * @return void
     */
    private static function addRoute($method, $path, $action, $middleware = null): void
    {
        self::$routes[] = array(
            'path' => $path,
            'controller' => $action[0],
            'action' => $action[1],
            'middleware' => $middleware,
            'method' => $method,
        );
    }

    /**
     * Adiciona rotas do tipo GET
     * @param $path
     * @param $action
     * @param $middleware
     * @return void
     */
    public static function get($path, $action, $middleware = null): void
    {
        self::addRoute('GET', $path, $action, $middleware);
    }

    /** Adiciona rotas do tipo POST
     * @param $path
     * @param $action
     * @param $middleware
     * @return void
     */
    public static function post($path, $action, $middleware = null): void
    {
        self::addRoute('POST', $path, $action, $middleware);
    }

    /**
     * Inicializa o processo para obtenção dos dados para construir a renderização
     * @return void
     */
    private function buildUri(): void
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $requestUri = preg_replace('/\?.*/', '', $requestUri);
        $url = preg_split('@/@', $requestUri, -1, PREG_SPLIT_NO_EMPTY);

        foreach (Router::$routes as $index => $route) {
            $path = preg_split('@/@', $route['path'], -1, PREG_SPLIT_NO_EMPTY);

            if ($url === $path && $_SERVER['REQUEST_METHOD'] === $route['method']) {
                $this->buildController($route['controller'], $route['action'], $route['middleware']);
                die();
            }
        }
        Error::throwError(Error::NOT_FOUND, 'Não foi possível encontrar o recurso solicitado.');
    }

    /**
     * Executa o middleware, caso exista, depois o controller e, por último, devolve a resposta
     * @param $controller
     * @param $action
     * @param $middleware
     * @return void
     */
    private function buildController($controller, $action, $middleware): void
    {
        $request = new Request();
        if ($middleware != null) {
            call_user_func([$middleware, 'handle'], $request);
        }
        $this->sendResponse((new $controller)->$action($middleware));
    }

    /**
     * Retorna a resposta da requisição
     * @param $content
     * @return void
     */
    private function sendResponse($content): void
    {
        (new Response(200, $content))->sendResponse();
    }
}