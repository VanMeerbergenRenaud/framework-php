<?php

namespace Core\Middlewares;

class Authenticated
{
    public function handle(): void
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }
    }
}