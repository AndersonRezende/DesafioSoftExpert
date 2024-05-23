<?php

use DesafioSoftExpert\Controllers\AuthController;
use DesafioSoftExpert\Controllers\HomeController;
use DesafioSoftExpert\Controllers\ProductController;
use DesafioSoftExpert\Controllers\ProductTypeController;
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

Router::get('/product_types', [ProductTypeController::class, 'index'], AuthMiddleware::class);
Router::get('/product_types/new', [ProductTypeController::class, 'create'], AuthMiddleware::class);
Router::get('/product_types/edit/{id}', [ProductTypeController::class, 'edit'], AuthMiddleware::class);
Router::post('/product_types/store', [ProductTypeController::class, 'store'], AuthMiddleware::class);
Router::post('/product_types/update/{id}', [ProductTypeController::class, 'update'], AuthMiddleware::class);
Router::post('/product_types/destroy/{id}', [ProductTypeController::class, 'destroy'], AuthMiddleware::class);

Router::get('/products', [ProductController::class, 'index'], AuthMiddleware::class);
Router::get('/products/{id}', [ProductController::class, 'show'], AuthMiddleware::class);
Router::get('/products/new', [ProductController::class, 'create'], AuthMiddleware::class);
Router::get('/products/edit/{id}', [ProductController::class, 'edit'], AuthMiddleware::class);
Router::post('/products/store', [ProductController::class, 'store'], AuthMiddleware::class);
Router::post('/products/update/{id}', [ProductController::class, 'update'], AuthMiddleware::class);
Router::post('/products/destroy/{id}', [ProductController::class, 'destroy'], AuthMiddleware::class);
