<?php

namespace Core\Middlewares;

use Core\Response;

class Auth implements \Core\Contracts\Middleware
{
    public function handle(): void
    {
        if (!\Core\Auth::check()) {
            Response::redirect('/login');
        }
    }
}
