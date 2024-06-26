<?php

namespace DesafioSoftExpert\Core;

class Request
{
    /**
     * Método http da requisição
     * @var string
     */
    private $httpMethod;

    /**
     * Rota da página
     * @var string
     */
    private $uri;

    /**
     * Parâmetros da URL ($_GET)
     * @var array
     */
    private $queryParams = [];

    /**
     * Variáveis recebidas do POST da página ($_POST)
     * @var array
     */
    private $postVars = [];

    /**
     * Cabeçalho da requisição
     * @var array
     */
    private $headers = [];

    /**
     *
     */
    public function __construct()
    {
        $this->queryParams = $_GET ?? [];
        $this->postVars = $_POST ?? [];
        $this->headers = getallheaders();
        $this->httpMethod = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->uri = $_SERVER['REQUEST_URI'] ?? '';
    }

    /**
     * Obtém o valor de um parâmetro chave passado por parâmetro
     * @param $param
     * @return mixed|null
     */
    public function get($param)
    {
        return $this->queryParams[$param] ?? $this->postVars[$param] ?? null;
    }

    /**
     * @return mixed|string
     */
    public function getHttpMethod()
    {
        return $this->httpMethod;
    }

    /**
     * @return mixed|string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @return array
     */
    public function getQueryParams()
    {
        return $this->queryParams;
    }

    /**
     * @return array
     */
    public function getPostVars()
    {
        return $this->postVars;
    }

    /**
     * @return array|false
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    public function getFile($name)
    {
        return $_FILES[$name];
    }
}