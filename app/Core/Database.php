<?php

namespace DesafioSoftExpert\Core;

use PDO;

class Database
{
    private static $connection;

    public static function getConnection()
    {
        if (!isset(self::$connection)) {
            self::$connection = new PDO("mysql:host=localhost;dbname=desafiosoft_expert", 'root', 'root');
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$connection;
    }

}