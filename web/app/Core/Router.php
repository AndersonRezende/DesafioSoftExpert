<?php

namespace DesafioSoftExpert\Core;

use DesafioSoftExpert\Controllers\ErrorController;
use DesafioSoftExpert\Error\Error;

class Router
{
    private static string $parametersRegex = '/\{([a-zA-Z]+)}/';
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

    /**
     * Adiciona rotas do tipo POST
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

        $route = $this->matchUri($requestUri, $_SERVER['REQUEST_METHOD']);
        if ($route !== false) {
            $parameters = $this->getParameters($route, $requestUri);
            $this->buildController($route['controller'], $route['action'], $route['middleware'], $parameters);
        } else {
            Error::throwError(Error::NOT_FOUND, 'Não foi possível encontrar o recurso solicitado.');
        }
        die();

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
        $parameters['request'] = $request;
        if ($middleware != null) {
            call_user_func([$middleware, 'handle'], $request);
        }
        try {
            $this->sendResponse(call_user_func_array([$controller, $action], $parameters));
        } catch (\Exception $e) {
            Error::throwError(Error::NOT_FOUND, 'Não foi possível encontrar o recurso solicitado.');
        }
    }

    /**
     * Busca a rota desejada com base na url requisitada.
     * @param string $requestUri <p>
     * A rota requisitada.
     * </p>
     * @return array[]|false Se for encontrada uma rota
     * correspondente a url requisitada, será retornado
     * a rota equivalente. Caso contrário, será retornado
     * false.
     */
    private function matchUri(string $requestUri, string $method)
    {
        $routesWithParameters = [];
        $routesWithoutParameters = [];
        foreach (self::$routes as $route) {
            if ($route['method'] === $method) {
                if (!empty($route['parameters'])) {
                    $routesWithParameters[] = $route;
                } else {
                    $routesWithoutParameters[] = $route;
                }
            }
        }

        foreach ($routesWithoutParameters as $route) {
            if ($route['path'] === $requestUri) {
                return $route;
            }
        }

        $explodedUri = explode('/', $requestUri);
        foreach ($routesWithParameters as $route) {
            $explodedRouteWithParameters = explode('/', $route['path']);

            if (sizeof($explodedUri) === sizeof($explodedRouteWithParameters)) {
                $selectedRoute = false;
                foreach ($explodedRouteWithParameters as $index => $routePart) {
                    if (preg_match('/\{([a-zA-Z]+)}/', $routePart, $matches) === 1
                        || $routePart === $explodedUri[$index]) {
                        $selectedRoute = true;
                    } else {
                        $selectedRoute = false;
                        break;
                    }

                }
                if ($selectedRoute) {
                    return $route;
                }
            }
        }
        return false;
    }

    /**
     * Obtém os parâmetros da rota solicitada.
     * @param array $route <p>
     * O array contendo os dados da rota.
     * </p>
     * * @param string $requestUri <p>
     * A string contendo a rota requisitada.
     * </p>
     * @return array[] Retorna o array contendo chave/valor
     * dos parâmetros necessários da rota.
     */
    private function getParameters(array $route, string $requestUri): array
    {
        if (empty($route['parameters'])) {
            return [];
        }

        $variables = [];
        $explodedUri = explode('/', $requestUri);
        $explodedRoute = explode('/', $route['path']);
        foreach ($explodedRoute as $index => $routePart) {
            if (preg_match(self::$parametersRegex, $routePart, $matches) === 1) {
                $variables[$matches[1]] = $explodedUri[$index];
            }
        }
        return $variables;
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