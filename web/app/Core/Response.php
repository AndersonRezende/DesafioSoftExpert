<?php

namespace DesafioSoftExpert\Core;

class Response
{

    /**
     * Código do status http
     * @var int
     */
    private int $httpCode = 200;

    /**
     * Cabeçalho da resposta
     * @var array
     */
    private array $headers = [];

    /**
     * Tipo de conteúdo retornado
     * @var string
     */
    private string $contentType = 'text/html';

    /**
     * Conteúdo da resposta
     * @var mixed
     */
    private $content;

    /**
     * @param int $httpCode
     * @param string $contentType
     * @param mixed $content
     */
    public function __construct(int $httpCode, $content, string $contentType = 'text/html')
    {
        $this->httpCode = $httpCode;
        $this->content = $content;
        $this->setContentType($contentType);
    }

    /**
     * Altera o content type da resposta
     * @param string $contentType
     * @return void
     */
    public function setContentType(string $contentType)
    {
        $this->contentType = $contentType;
        $this->addHeader('Content-Type', $contentType);
    }

    /**
     * Adiciona um dado ao cabeçalho da resposta
     * @param $key
     * @param $value
     * @return void
     */
    public function addHeader($key, $value)
    {
        $this->headers[$key] = $value;
    }

    /**
     * Envia a resposta
     * @return void
     */
    public function sendResponse()
    {
        $this->sendHeaders();
        switch ($this->contentType) {
            case 'text/html':
                echo $this->content;
                break;
        }
    }

    /**
     * Envia os headers ao navegador
     * @return void
     */
    private function sendHeaders()
    {
        http_response_code($this->httpCode);
        foreach ($this->headers as $key => $value) {
            header($key.':'.$value);
        }
    }
}