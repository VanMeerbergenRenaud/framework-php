<?php

/** @var Core\Router $router */

use App\Http\Controllers\AttendanceController;

/*$router->get('/attendances', [AttendanceController::class, 'index'])->only('auth');

$router->get('/attendance', [AttendanceController::class, 'show'])->only('auth');

$router->get('/attendance/create', [AttendanceController::class, 'create'])->only('auth');
$router->post('/attendance', [AttendanceController::class, 'store'])->only('auth')->csrf();

$router->get('/attendance/edit', [AttendanceController::class, 'edit'])->only('auth');*/
$router->patch('/attendance', [AttendanceController::class, 'update'])->only('auth')->csrf();

/*$router->delete('/attendance', [AttendanceController::class, 'destroy'])->only('auth')->csrf();*/