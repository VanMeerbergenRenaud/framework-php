<?php

namespace Core;

use App\Models\User;
use JetBrains\PhpStorm\NoReturn;

class Auth
{
    #[NoReturn]
    public static function attempt(array $credentials): void
    {
        $user = new User(base_path('.env.local.ini'));
        $user_data = $user->findByEmail($credentials['email']);

        if (password_verify($credentials['password'], $user_data->password)) {
            $_SESSION['user'] = $user_data;
            Response::redirect('/jiris');
        }

        $_SESSION['errors']['password'] = 'Le mot de passe ne correspond pas à l’email fourni';
        $_SESSION['old'] = $credentials;
        Response::redirect('/login');
    }

    public static function check(): bool
    {
        return isset($_SESSION['user']);
    }

    public static function id()
    {
        return $_SESSION['user']->id;
    }
}
