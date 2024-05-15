<?php

use Core\Response;
use Core\Router;

const BASE_PATH = __DIR__.'/..';
require BASE_PATH.'/core/helpers/functions.php';
require base_path('vendor/autoload.php');

session_start();

$router = new Router();
require base_path('routes/web.php');

if (isset($_REQUEST['_method']) && !in_array(strtoupper($_REQUEST['_method']), ['PUT', 'PATCH', 'DELETE'])) {
    Response::abort(Response::BAD_REQUEST);
}

$request_method = $_REQUEST['_method'] ?? $_SERVER['REQUEST_METHOD'];
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$router->route_to_controller($request_method, $request_uri);
