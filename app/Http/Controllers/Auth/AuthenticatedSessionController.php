<?php

namespace App\Http\Controllers\Auth;

use Core\Auth;
use Core\Response;
use Core\Validator;
use JetBrains\PhpStorm\NoReturn;

class AuthenticatedSessionController
{
    public function create(): void
    {
        view('auth.login.create');
    }

    #[NoReturn]
    public function store(): void
    {
        $data = Validator::check([
            'email' => 'required|email|exists:user,email',
            'password' => 'required|password',
        ]);

        Auth::attempt($data);
    }

    #[NoReturn]
    public function destroy(): void
    {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }
        session_destroy();
        Response::redirect('/login');
    }
}
