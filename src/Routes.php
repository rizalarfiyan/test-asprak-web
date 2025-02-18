<?php

use App\Controllers\HomeController;
use App\Controllers\StudentController;
use App\Core\Router;

$router = new Router();
$router->get('/', HomeController::class, 'index');
$router->get('/student', StudentController::class, 'index');
$router->post('/student', StudentController::class, 'create');
$router->get('/student/table', StudentController::class, 'table', true);
$router->get('/student/create', StudentController::class, 'htmxCreate', true);
$router->get('/student/delete/{id}', StudentController::class, 'htmxDelete', true);
$router->delete('/student/{id}', StudentController::class, 'delete');
$router->dispatch();
