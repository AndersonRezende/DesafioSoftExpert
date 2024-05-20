<?php

use DesafioSoftExpert\Controllers\HomeController;
use DesafioSoftExpert\Controllers\UserController;
use DesafioSoftExpert\Core\Router;

Router::get('/', [HomeController::class, 'index']);
Router::get('/home', [HomeController::class, 'index']);
Router::get('/home/teste', [HomeController::class, 'index']);
Router::post('/home/teste', [HomeController::class, 'index'], \DesafioSoftExpert\Middleware\BaseMiddleware::class);

Router::get('/user', [UserController::class, 'index']);