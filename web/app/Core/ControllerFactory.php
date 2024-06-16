<?php

namespace DesafioSoftExpert\Core;

class ControllerFactory
{

    private ContainerInterface $container;
    private string $controller;
    private string $action;
    private array $parameters;

    /**
     * @param $container
     * @param $controller
     * @param $action
     * @param $parameters
     */
    public function __construct($container, $controller, $action, $parameters)
    {
        $this->container = $container;
        $this->controller = $controller;
        $this->action = $action;
        $this->parameters = $parameters;
    }

    public function execute()
    {
        $this->container->set('controller', $this->controller);
        $controller = $this->container->get('controller');

        return call_user_func_array([$controller, $this->action], $this->parameters);
    }
}