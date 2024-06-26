<?php

namespace DesafioSoftExpert\Core;

use PDO;

class Database extends PDO
{
    private static self $connection;

    private function __construct($dsn, $username = null, $password = null, $options = null)
    {
        parent::__construct($dsn, $username, $password, $options);
    }

    public static function getConnection(): self
    {
        if (!isset(self::$connection)) {
            $dbHost = getenv('DB_HOST');
            $dbName = getenv('POSTGRES_DB');
            $dbUser = getenv('POSTGRES_USER');
            $dbPassword = getenv('POSTGRES_PASSWORD');

            $dsn = "pgsql:host=$dbHost;dbname=$dbName";
            self::$connection = new self($dsn, $dbUser, $dbPassword);
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$connection;
    }

}