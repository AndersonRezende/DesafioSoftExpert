<?php

namespace DesafioSoftExpert\Core;

use Closure;
use DesafioSoftExpert\Error\Exceptions\EntryNotFoundException;
use DesafioSoftExpert\Error\Exceptions\NonInstantiableException;
use Exception;
use ReflectionClass;
use ReflectionException;

class Container implements ContainerInterface
{
    protected array $bindings = [];

    /**
     * @throws Exception
     */
    public function get($id)
    {
        if (!$this->has($id)) {
            throw new EntryNotFoundException('Nenhum vínculo para o id ' . $id);
        }

        return $this->resolve($this->bindings[$id]);
    }

    public function set($id, $concrete)
    {
        $this->bindings[$id] = $concrete;
    }

    protected function has($id): bool
    {
        return isset($this->bindings[$id]);
    }

    /**
     * @throws ReflectionException
     */
    protected function resolve($concrete)
    {
        if ($concrete instanceof Closure) {
            return $concrete($this);
        }

        if (is_string($concrete)) {
            return $this->build($concrete);
        }

        return $concrete;
    }

    /**
     * @throws ReflectionException
     * @throws Exception
     */
    protected function build($concrete)
    {
        $reflector = new ReflectionClass($concrete);
        if (!$reflector->isInstantiable()) {
            throw new NonInstantiableException("A classe {$concrete} não é instanciável.");
        }

        $constructor = $reflector->getConstructor();

        if (is_null($constructor)) {
            return new $concrete();
        }

        $parameters = $constructor->getParameters();
        $dependencies = $this->getDependencies($parameters);

        return $reflector->newInstanceArgs($dependencies);
    }

    /**
     * @throws Exception
     */
    protected function getDependencies($parameters): array
    {
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $dependency = $parameter->getClass();
            if (is_null($dependency)) {
                $dependencies[] = $this->resolveNonClass($parameter);
            } else {
                if (!$this->has($parameter->name)) {
                    $this->set($parameter->name, $dependency->name);
                }
                $dependencies[] = $this->get($parameter->name);
            }
        }
        return $dependencies;
    }

    /**
     * @throws Exception
     */
    protected function resolveNonClass($parameter)
    {
        if ($parameter->isDefaultValueAvailable()) {
            return $parameter->getDefaultValue();
        }

        throw new Exception('Não foi possível resolver a dependência ' . $parameter->name);
    }
}