<?php

use App\Http\Controllers\JiriController;

/** @var Core\Router $router */
$router->get('/jiris', [JiriController::class, 'index'])->only('auth');

$router->get('/jiri', [JiriController::class, 'show'])->only('auth');

$router->get('/jiri/create', [JiriController::class, 'create'])->only('auth');
$router->post('/jiri', [JiriController::class, 'store'])->only('auth')->csrf();

$router->get('/jiri/edit', [JiriController::class, 'edit'])->only('auth');
$router->patch('/jiri', [JiriController::class, 'update'])->only('auth')->csrf();

$router->delete('/jiri', [JiriController::class, 'destroy'])->only('auth')->csrf();