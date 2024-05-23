<?php

use DesafioSoftExpert\Core\App;
use DesafioSoftExpert\Core\Session;
use Dotenv\Dotenv;

require_once __DIR__ . "/../config/routes.php";

$dotenv = Dotenv::createUnsafeImmutable(__DIR__ . '/../');
$dotenv->load();

Session::start();

$app = new App();