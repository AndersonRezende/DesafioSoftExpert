<?php

use DesafioSoftExpert\Controllers\HomeController;
use DesafioSoftExpert\Controllers\UserController;
use DesafioSoftExpert\Core\Router;

Router::get('/', [HomeController::class, 'index']);
Router::get('/home', [HomeController::class, 'index']);
Router::get('/home/teste', [HomeController::class, 'index']);
Router::post('/home/teste', [HomeController::class, 'index'], \DesafioSoftExpert\Middleware\BaseMiddleware::class);

Router::get('/user', [UserController::class, 'index']);
Router::get('/user/{id}', [UserController::class, 'show']);
Router::get('/user/new', [UserController::class, 'create']);
Router::get('/user/{id}/name/{name}', [UserController::class, 'list']);