<?php

namespace DesafioSoftExpert\Core;

use DesafioSoftExpert\Repositories\Repository;
use PDO;
use ReflectionClass;
use ReflectionParameter;

class RepositoryFactory
{
    /**
     * @throws \ReflectionException
     */
    public static function createRepository(ReflectionClass $repository): Repository
    {
        $parameters = [];
        foreach ($repository->getConstructor()->getParameters() as $parameter) {
            if ($parameter->getClass()->getName() === PDO::class)
                $parameters[] = Database::getConnection();
        }
        $reflection = new ReflectionClass($repository->getName());
        return $reflection->newInstanceArgs($parameters);
    }
}