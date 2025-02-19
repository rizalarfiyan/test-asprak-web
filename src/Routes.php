<?php

use App\Controllers\HomeController;
use App\Controllers\StudentController;
use App\Controllers\StudyProgramController;
use App\Core\Router;

$router = new Router();

// Home Page
$router->get('/', HomeController::class, 'index');

// Student
$router->get('/student', StudentController::class, 'index');
$router->post('/student', StudentController::class, 'create');
$router->get('/student/table', StudentController::class, 'table', true);
$router->get('/student/create', StudentController::class, 'htmxCreate', true);
$router->get('/student/update/{id}', StudentController::class, 'htmxUpdate', true);
$router->get('/student/delete/{id}', StudentController::class, 'htmxDelete', true);
$router->put('/student/{id}', StudentController::class, 'update');
$router->delete('/student/{id}', StudentController::class, 'delete');

// Study Program
$router->get('/study-program', StudyProgramController::class, 'index');
$router->get('/study-program/table', StudyProgramController::class, 'table', true);

$router->dispatch();
