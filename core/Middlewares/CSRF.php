<?php

namespace Core\Middlewares;

use Core\Response;

class CSRF implements \Core\Contracts\Middleware
{
    public function handle(): void
    {
        if (!isset($_REQUEST['_csrf']) || $_SESSION['csrf_token'] !== $_REQUEST['_csrf']) {
            Response::abort(Response::BAD_REQUEST);
        }
        unset($_SESSION['csrf_token']);
    }
}
