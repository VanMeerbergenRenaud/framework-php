<?php

namespace Core\Middlewares;

use Core\Response;

class CSRF
{
    public function handle(): void
    {
        if (!isset($_POST['_csrf']) || $_POST['_csrf'] !== $_SESSION['csrf_token']) {
            Response::abort(Response::BAD_REQUEST);
        }

        unset($_SESSION['csrf_token']);
    }
}