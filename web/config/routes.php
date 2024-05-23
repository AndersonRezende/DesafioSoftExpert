<?php

use DesafioSoftExpert\Controllers\AuthController;
use DesafioSoftExpert\Controllers\HomeController;
use DesafioSoftExpert\Controllers\UserController;
use DesafioSoftExpert\Core\Router;
use DesafioSoftExpert\Middleware\AuthMiddleware;

Router::get('/', [HomeController::class, 'index'], AuthMiddleware::class);

Router::get('/login', [AuthController::class, 'login']);
Router::post('/auth', [AuthController::class, 'authenticate']);
Router::get('/logout', [AuthController::class, 'logout']);
Router::get('/register', [AuthController::class, 'register']);
Router::post('/register', [AuthController::class, 'registerPost']);

Router::get('/home', [HomeController::class, 'index'], AuthMiddleware::class);
Router::get('/home/teste', [HomeController::class, 'index'], AuthMiddleware::class);
Router::post('/home/teste', [HomeController::class, 'index'], \DesafioSoftExpert\Middleware\BaseMiddleware::class);

Router::get('/user', [UserController::class, 'index'], AuthMiddleware::class);
Router::get('/user/{id}', [UserController::class, 'show'], AuthMiddleware::class);
Router::get('/user/new', [UserController::class, 'create'], AuthMiddleware::class);
Router::get('/user/{id}/name/{name}', [UserController::class, 'list'], AuthMiddleware::class);