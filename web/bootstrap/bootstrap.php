<?php

use DesafioSoftExpert\Core\App;
use Dotenv\Dotenv;

$dotenv = Dotenv::createUnsafeImmutable(__DIR__ . '/../');
$dotenv->load();

$app = new App();
$app->run();