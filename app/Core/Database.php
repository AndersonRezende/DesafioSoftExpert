<?php

namespace DesafioSoftExpert\Core;

use PDO;

class Database
{
    private static PDO $connection;

    public static function getConnection()
    {
        if (!isset(self::$connection)) {
            self::$connection = new PDO(
                "mysql:host=".getenv('DB_HOST').";dbname=".getenv('DB_DATABASE'),
                getenv('DB_USERNAME'),
                getenv('DB_PASSWORD')
            );
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$connection;
    }

}