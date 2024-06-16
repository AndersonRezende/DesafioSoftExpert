<?php

namespace DesafioSoftExpert\Core;

class App
{
    public function __construct(ContainerInterface $container)
    {
        new Router($container);
    }
}