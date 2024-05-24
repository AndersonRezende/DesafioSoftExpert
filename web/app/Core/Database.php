<?php

namespace DesafioSoftExpert\Core;

use PDO;

class Database
{
    private static PDO $connection;

    public static function getConnection(): PDO
    {
        if (!isset(self::$connection)) {
            $dbHost = getenv('DB_HOST');
            $dbName = getenv('POSTGRES_DB');
            $dbUser = getenv('POSTGRES_USER');
            $dbPassword = getenv('POSTGRES_PASSWORD');

            $dsn = "pgsql:host=$dbHost;dbname=$dbName";
            self::$connection = new PDO($dsn, $dbUser, $dbPassword);
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$connection;
    }

}