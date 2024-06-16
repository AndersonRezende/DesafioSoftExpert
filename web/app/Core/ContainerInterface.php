<?php

namespace DesafioSoftExpert\Core;

interface ContainerInterface
{
    public function get($id);
    public function set($id, $concrete);
}