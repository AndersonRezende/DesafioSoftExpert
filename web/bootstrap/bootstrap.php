<?php

use DesafioSoftExpert\Core\App;
use DesafioSoftExpert\Core\Container;
use DesafioSoftExpert\Core\Database;
use DesafioSoftExpert\Core\Session;
use Dotenv\Dotenv;

require_once __DIR__ . "/../config/routes.php";

$dotenv = Dotenv::createUnsafeImmutable(__DIR__ . '/../');
$dotenv->load();

Session::start();

$container = new Container();
$container->set('pdo', Database::getConnection());

$app = new App($container);