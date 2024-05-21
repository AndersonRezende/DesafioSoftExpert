<?php

namespace DesafioSoftExpert\Core;

use DesafioSoftExpert\Controllers\ErrorController;
use DesafioSoftExpert\Error\Error;

class Router
{
    private static string $parametersRegex = '/\{([a-zA-Z]+)\}/';
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
        preg_match_all(self::$parametersRegex, $path, $matches);
        self::$routes[] = array(
            'path' => $path,
            'controller' => $action[0],
            'action' => $action[1],
            'middleware' => $middleware,
            'method' => $method,
            'parameters' => $matches[1],
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
            $parameters = $this->matchUriPattern($route['path'], $requestUri);
            if ($parameters !== false && $_SERVER['REQUEST_METHOD'] === $route['method']) {
                $this->buildController($route['controller'], $route['action'], $route['middleware'], $parameters);
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
    private function buildController($controller, $action, $middleware, $parameters): void
    {
        $request = new Request();
        if ($middleware != null) {
            call_user_func([$middleware, 'handle'], $request);
        }
        $this->sendResponse(call_user_func_array([$controller, $action], $parameters));
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

    /**
     * Busca a rota correspondente a uri informada e devolve um array contendo os parâmetros caso encontrado
     * ou false caso não exista correspondência.
     * @param $pattern
     * @param $uri
     * @return array|false
     */
    private function matchUriPattern($pattern, $uri)
    {
        $escapedPattern = preg_quote($pattern, '/');
        $regexPattern = preg_replace('/\\\{[a-zA-Z]+\\\}/', '([a-zA-Z0-9_\-]+)', $escapedPattern);
        $regexPattern = '/^' . $regexPattern . '$/';

        if (preg_match($regexPattern, $uri, $matches)) {
            array_shift($matches);
            preg_match_all('/\{([a-zA-Z]+)\}/', $pattern, $variableNames);
            $variableNames = $variableNames[1];
            $variables = array_combine($variableNames, $matches);

            return $variables;
        } else {
            return false;
        }
    }
}