<?php

use App\Http\Controllers\JiriController;

/** @var core\Router $router */
$router->get('/', [JiriController::class, 'index']);

$router->get('/jiris', [JiriController::class, 'index']);

$router->get('/jiri', [JiriController::class, 'show']);

$router->get('/jiri/create', [JiriController::class, 'create']);
$router->post('/jiri', [JiriController::class, 'store'])->csrf();

$router->get('/jiri/edit', [JiriController::class, 'edit']);
$router->patch('/jiri', [JiriController::class, 'update'])->csrf();

$router->delete('/jiri', [JiriController::class, 'destroy'])->csrf();
