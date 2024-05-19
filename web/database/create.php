<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createUnsafeImmutable(__DIR__ . '/../');
$dotenv->load();

$dbHost = getenv('DB_HOST');
$dbPort = getenv('DB_PORT', 5432);
$dbName = getenv('DB_DATABASE');
$dbUser = getenv('DB_USERNAME');
$dbPassword = getenv('DB_PASSWORD');

try {
    $dsn = "pgsql:host=$dbHost;dbname=postgres";
    $db = new PDO($dsn, $dbUser, $dbPassword);

    $sql = "CREATE DATABASE $dbName";
    $db->exec($sql);

    echo "Banco de dados $dbName criado com sucesso!";
} catch (PDOException $e) {
    switch ($e->getCode()) {
        case '42P04':
            echo "O banco de dados $dbName já existe!". PHP_EOL;
            break;
        default:
            echo "Erro ao criar o banco de dados: " . $e->getMessage() . PHP_EOL;
    }
} finally {
    $db = null;
}
