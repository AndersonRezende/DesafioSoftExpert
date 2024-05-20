<?php

namespace DesafioSoftExpert\Core;

class Request
{
    public array $params = [];
    public array $queryStrings = [];

    /**
     * @param array $params
     * @param array $queryStrings
     */
    public function __construct(array $params, array $queryStrings)
    {
        $this->params = $params;
        $this->queryStrings = $queryStrings;
    }

    public function get($param)
    {
        return $this->params[$param] ?? null;
    }
}