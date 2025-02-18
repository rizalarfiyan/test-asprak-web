<?php

use App\Controllers\HomeController;
use App\Controllers\StudentController;
use App\Core\Router;

$router = new Router();
$router->get('/', HomeController::class, 'index');
$router->get('/student', StudentController::class, 'index');
$router->get('/student/table', StudentController::class, 'table');
$router->dispatch();
