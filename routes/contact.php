<?php

use App\Http\Controllers\ContactController;

/** @var Core\Router $router */
$router->get('/contacts', [ContactController::class, 'index'])->only('auth');

$router->get('/contact', [ContactController::class, 'show'])->only('auth');

$router->get('/contact/create', [ContactController::class, 'create'])->only('auth');
$router->post('/contact', [ContactController::class, 'store'])->only('auth')->csrf();

$router->get('/contact/edit', [ContactController::class, 'edit'])->only('auth');
$router->patch('/contact', [ContactController::class, 'update'])->only('auth')->csrf();

$router->delete('/contact', [ContactController::class, 'destroy'])->only('auth')->csrf();
