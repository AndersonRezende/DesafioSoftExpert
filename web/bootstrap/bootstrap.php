<?php

use DesafioSoftExpert\Core\App;
use Dotenv\Dotenv;

require_once __DIR__ . "/../config/routes.php";

$dotenv = Dotenv::createUnsafeImmutable(__DIR__ . '/../');
$dotenv->load();

$app = new App();