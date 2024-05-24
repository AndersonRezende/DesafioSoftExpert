<?php

use DesafioSoftExpert\Controllers\AuthController;
use DesafioSoftExpert\Controllers\HomeController;
use DesafioSoftExpert\Controllers\ProductController;
use DesafioSoftExpert\Controllers\ProductTypeController;
use DesafioSoftExpert\Controllers\SalesController;
use DesafioSoftExpert\Controllers\TaxController;
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

Router::get('/tax', [TaxController::class, 'index'], AuthMiddleware::class);
Router::get('/tax/{id}', [TaxController::class, 'show'], AuthMiddleware::class);
Router::get('/tax/new', [TaxController::class, 'create'], AuthMiddleware::class);
Router::get('/tax/edit/{id}', [TaxController::class, 'edit'], AuthMiddleware::class);
Router::post('/tax/store', [TaxController::class, 'store'], AuthMiddleware::class);
Router::post('/tax/update/{id}', [TaxController::class, 'update'], AuthMiddleware::class);
Router::post('/tax/destroy/{id}', [TaxController::class, 'destroy'], AuthMiddleware::class);

Router::get('/sales', [SalesController::class, 'index'], AuthMiddleware::class);
Router::get('/sales/{id}', [SalesController::class, 'show'], AuthMiddleware::class);
Router::get('/sales/new', [SalesController::class, 'create'], AuthMiddleware::class);
Router::post('/sales/store', [SalesController::class, 'store'], AuthMiddleware::class);
Router::post('/sales/destroy/{id}', [SalesController::class, 'destroy'], AuthMiddleware::class);
